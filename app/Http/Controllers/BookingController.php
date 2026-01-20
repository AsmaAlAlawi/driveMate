<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Instructor;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // لا تحتاج __construct لأن الحماية في routes/web.php

    // عرض نموذج الحجز
    public function create(Request $request, Instructor $instructor)
    {
        $date = $request->input('date');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');

        // التحقق من التوفر
        if (!$instructor->isAvailableAt($date, $startTime, $endTime)) {
            return redirect()->back()->with('error', 'هذا الوقت غير متاح للحجز');
        }

        return view('bookings.create', compact('instructor', 'date', 'startTime', 'endTime'));
    }

    // حفظ الحجز
    public function store(Request $request)
    {
        $validated = $request->validate([
            'instructor_id' => 'required|exists:instructors,id',
            'booking_date' => 'required|date|after:today',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration_hours' => 'required|integer|min:1',
            'student_notes' => 'nullable|string|max:500',
        ]);

        $instructor = Instructor::findOrFail($validated['instructor_id']);

        // التحقق من التوفر مرة أخرى
        if (!$instructor->isAvailableAt(
            $validated['booking_date'],
            $validated['start_time'],
            $validated['end_time']
        )) {
            return redirect()->back()->with('error', 'عذراً، تم حجز هذا الوقت من قبل متدرب آخر');
        }

        DB::beginTransaction();
        try {
            // حساب السعر الإجمالي
            $totalPrice = $instructor->hourly_rate * $validated['duration_hours'];

            // إنشاء الحجز
            $booking = Booking::create([
                'student_id' => Auth::id(),
                'instructor_id' => $instructor->id,
                'booking_date' => $validated['booking_date'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'duration_hours' => $validated['duration_hours'],
                'total_price' => $totalPrice,
                'status' => 'pending',
                'student_notes' => $validated['student_notes'],
            ]);

            // إنشاء سجل الدفع
            Payment::create([
                'booking_id' => $booking->id,
                'student_id' => Auth::id(),
                'amount' => $totalPrice,
                'status' => 'pending',
            ]);

            DB::commit();

            // التوجه إلى صفحة الدفع
            return redirect()->route('payment.checkout', $booking);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء الحجز');
        }
    }

    // عرض تفاصيل الحجز
    public function show(Booking $booking)
    {
        // التحقق من الصلاحية
        if ($booking->student_id !== Auth::id() && 
            (!Auth::user()->instructor || $booking->instructor->user_id !== Auth::id()) &&
            !Auth::user()->isAdmin()) {
            abort(403);
        }

        $booking->load(['instructor.region', 'student', 'payment', 'review']);

        return view('bookings.show', compact('booking'));
    }

    // قائمة حجوزات المتدرب
    public function myBookings()
    {
        $bookings = Booking::where('student_id', Auth::id())
            ->with(['instructor.region', 'payment'])
            ->orderBy('booking_date', 'desc')
            ->paginate(10);

        return view('bookings.my-bookings', compact('bookings'));
    }

    // قائمة حجوزات المدرب
    public function instructorBookings()
    {
        $instructor = Auth::user()->instructor;
        
        if (!$instructor) {
            abort(403);
        }

        $bookings = Booking::where('instructor_id', $instructor->id)
            ->with(['student', 'payment'])
            ->orderBy('booking_date', 'desc')
            ->paginate(10);

        return view('bookings.instructor-bookings', compact('bookings'));
    }

    // إلغاء الحجز
    public function cancel(Booking $booking)
    {
        if ($booking->student_id !== Auth::id()) {
            abort(403);
        }

        if (!$booking->canBeCancelled()) {
            return redirect()->back()->with('error', 'لا يمكن إلغاء هذا الحجز');
        }

        $booking->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        // تحديث حالة الدفع إذا كان مدفوعاً
        if ($booking->payment && $booking->payment->status === 'paid') {
            $booking->payment->update(['status' => 'refunded']);
        }

        return redirect()->back()->with('success', 'تم إلغاء الحجز بنجاح');
    }

    // إكمال الحجز (للمدرب فقط)
    public function complete(Booking $booking)
    {
        $instructor = Auth::user()->instructor;

        if (!$instructor || $booking->instructor_id !== $instructor->id) {
            abort(403);
        }

        $booking->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم تأكيد إكمال الحصة التدريبية');
    }
}