<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // صفحة الدفع
    public function checkout(Booking $booking)
    {
        // التحقق من الصلاحية
        if ($booking->student_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'pending') {
            return redirect()->route('bookings.show', $booking)
                ->with('error', 'هذا الحجز تم الدفع له مسبقاً أو تم إلغاؤه');
        }

        $booking->load(['instructor', 'payment']);

        return view('payment.checkout', compact('booking'));
    }

    // معالجة الدفع مع ثواني
    public function process(Booking $booking)
    {
        if ($booking->student_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['student', 'instructor', 'payment']);

        // الحصول على الإعدادات
        $baseUrl = config('thawani.base_url');
        $apiKey = config('thawani.api_key');
        $publishableKey = config('thawani.publishable_key');

        // تحويل السعر إلى بيسة (1 ريال = 1000 بيسة)
        $amountInBaisa = (int) ($booking->total_price * 1000);

        $data = [
            'client_reference_id' => 'BOOKING-' . $booking->id,
            'mode' => 'payment',
            'products' => [
                [
                    'name' => 'حصة تدريب قيادة - ' . $booking->instructor->full_name,
                    'quantity' => 1,
                    'unit_amount' => $amountInBaisa,
                ]
            ],
            'success_url' => route('payment.success') . '?booking_id=' . $booking->id,
            'cancel_url' => route('payment.cancel') . '?booking_id=' . $booking->id,
            'metadata' => [
                'booking_id' => $booking->id,
                'student_name' => $booking->student->name,
                'instructor_name' => $booking->instructor->full_name,
            ],
        ];

        try {
            // إرسال الطلب لثواني
            $response = Http::withHeaders([
                'thawani-api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->post($baseUrl . '/api/v1/checkout/session', $data);

            if ($response->successful()) {
                $result = $response->json();
                $sessionId = $result['data']['session_id'];

                // تحديث معلومات الدفع
                $booking->payment->update([
                    'session_id' => $sessionId,
                ]);

                // التوجه إلى صفحة الدفع في ثواني
                $checkoutUrl = $baseUrl . '/pay/' . $sessionId;
                $checkoutUrl .= '?key=' . $publishableKey;

                return redirect()->away($checkoutUrl);
            }

            Log::error('Thawani payment error', [
                'response' => $response->json(),
                'booking_id' => $booking->id
            ]);

            return redirect()->back()->with('error', 'حدث خطأ في بوابة الدفع. يرجى المحاولة مرة أخرى.');

        } catch (\Exception $e) {
            Log::error('Payment exception', [
                'message' => $e->getMessage(),
                'booking_id' => $booking->id
            ]);

            return redirect()->back()->with('error', 'حدث خطأ غير متوقع. يرجى المحاولة لاحقاً.');
        }
    }

    // صفحة نجاح الدفع
    public function success(Request $request)
    {
        $bookingId = $request->query('booking_id');
        $booking = Booking::with(['payment', 'instructor'])->findOrFail($bookingId);

        if ($booking->student_id !== Auth::id()) {
            abort(403);
        }

        // الحصول على الإعدادات
        $baseUrl = config('thawani.base_url');
        $apiKey = config('thawani.api_key');

        // التحقق من حالة الدفع مع ثواني
        try {
            $response = Http::withHeaders([
                'thawani-api-key' => $apiKey,
            ])->get($baseUrl . '/api/v1/checkout/session/' . $booking->payment->session_id);

            if ($response->successful()) {
                $result = $response->json();

                if ($result['data']['payment_status'] === 'paid') {
                    // تحديث حالة الحجز والدفع
                    $booking->update([
                        'status' => 'confirmed',
                        'confirmed_at' => now(),
                    ]);

                    $booking->payment->update([
                        'status' => 'paid',
                        'payment_reference' => $result['data']['invoice'] ?? null,
                        'paid_at' => now(),
                    ]);

                    // تحديث إحصائيات المدرب
                    $booking->instructor->increment('total_bookings');

                    return view('payment.success', compact('booking'));
                }
            }

        } catch (\Exception $e) {
            Log::error('Payment verification error', [
                'message' => $e->getMessage(),
                'booking_id' => $booking->id
            ]);
        }

        return redirect()->route('bookings.show', $booking)
            ->with('error', 'لم نتمكن من تأكيد الدفع. يرجى التواصل مع الدعم.');
    }

    // صفحة إلغاء الدفع
    public function cancel(Request $request)
    {
        $bookingId = $request->query('booking_id');
        $booking = Booking::findOrFail($bookingId);

        if ($booking->student_id !== Auth::id()) {
            abort(403);
        }

        return view('payment.cancel', compact('booking'));
    }
}