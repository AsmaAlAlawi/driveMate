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
    // احذف __construct تماماً
    // أو استخدم هذا:
    
    public function __construct()
    {
        // تأكد من import Controller الصحيح في أعلى الملف
        parent::__construct();
    }

    // عرض نموذج الحجز
    public function create(Request $request, Instructor $instructor)
    {
        // تحقق من تسجيل الدخول يدوياً
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $date = $request->input('date');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');

        // التحقق من التوفر
        if (!$instructor->isAvailableAt($date, $startTime, $endTime)) {
            return redirect()->back()->with('error', 'هذا الوقت غير متاح للحجز');
        }

        return view('bookings.create', compact('instructor', 'date', 'startTime', 'endTime'));
    }

    // باقي الدوال...
}