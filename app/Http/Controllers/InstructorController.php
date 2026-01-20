<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\InstructorAvailability;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::where('status', 'active')
            ->with('region')
            ->orderBy('average_rating', 'desc')
            ->paginate(12);

        return view('instructors.index', compact('instructors'));
    }

    public function show(Instructor $instructor)
    {
        $instructor->load(['region', 'reviews.student', 'availability']);
        
        // احصائيات المدرب
        $completedBookings = $instructor->bookings()->where('status', 'completed')->count();
        
        // التقييمات الأخيرة
        $recentReviews = $instructor->reviews()
            ->with('student')
            ->latest()
            ->take(5)
            ->get();

        return view('instructors.show', compact('instructor', 'completedBookings', 'recentReviews'));
    }

    // التحقق من الأوقات المتاحة
    public function checkAvailability(Request $request, Instructor $instructor)
    {
        $date = $request->input('date');
        $dayOfWeek = Carbon::parse($date)->dayOfWeek;

        // الحصول على أوقات التوفر لهذا اليوم
        $availability = $instructor->availability()
            ->where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->get();

        if ($availability->isEmpty()) {
            return response()->json([
                'available' => false,
                'message' => 'المدرب غير متوفر في هذا اليوم'
            ]);
        }

        // الحصول على الحجوزات الموجودة
        $existingBookings = $instructor->bookings()
            ->where('booking_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->get(['start_time', 'end_time']);

        // إنشاء قائمة بالأوقات المتاحة (كل ساعة)
        $availableSlots = [];
        
        foreach ($availability as $slot) {
            $start = Carbon::parse($slot->start_time);
            $end = Carbon::parse($slot->end_time);

            while ($start < $end) {
                $slotStart = $start->format('H:i');
                $slotEnd = $start->addHour()->format('H:i');

                // التحقق من عدم تعارض مع حجوزات موجودة
                $isBooked = false;
                foreach ($existingBookings as $booking) {
                    if ($slotStart >= $booking->start_time && $slotStart < $booking->end_time) {
                        $isBooked = true;
                        break;
                    }
                }

                if (!$isBooked && $start <= $end) {
                    $availableSlots[] = [
                        'start' => $slotStart,
                        'end' => $slotEnd,
                        'display' => Carbon::parse($slotStart)->format('h:i A') . ' - ' . 
                                   Carbon::parse($slotEnd)->format('h:i A')
                    ];
                }
            }
        }

        return response()->json([
            'available' => !empty($availableSlots),
            'slots' => $availableSlots
        ]);
    }
}