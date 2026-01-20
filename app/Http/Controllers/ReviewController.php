<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // عرض نموذج التقييم
    public function create(Booking $booking)
    {
        // التحقق من الصلاحية
        if ($booking->student_id !== Auth::id()) {
            abort(403);
        }

        if (!$booking->canBeReviewed()) {
            return redirect()->back()->with('error', 'لا يمكن تقييم هذا الحجز');
        }

        return view('reviews.create', compact('booking'));
    }

    // حفظ التقييم
    public function store(Request $request, Booking $booking)
    {
        if ($booking->student_id !== Auth::id()) {
            abort(403);
        }

        if (!$booking->canBeReviewed()) {
            return redirect()->back()->with('error', 'لا يمكن تقييم هذا الحجز');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'booking_id' => $booking->id,
            'instructor_id' => $booking->instructor_id,
            'student_id' => Auth::id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()
            ->route('bookings.show', $booking)
            ->with('success', 'شكراً لك! تم إضافة تقييمك بنجاح');
    }
}