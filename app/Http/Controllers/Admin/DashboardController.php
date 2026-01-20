<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Instructor;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        // الإحصائيات العامة
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_instructors' => Instructor::count(),
            'active_instructors' => Instructor::where('status', 'active')->count(),
            'pending_instructors' => Instructor::where('status', 'pending')->count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'completed_bookings' => Booking::where('status', 'completed')->count(),
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
        ];

        // الحجوزات الأخيرة
        $recentBookings = Booking::with(['student', 'instructor', 'payment'])
            ->latest()
            ->take(10)
            ->get();

        // المدربين الجدد في انتظار الموافقة
        $pendingInstructors = Instructor::where('status', 'pending')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        // إحصائيات شهرية
        $monthlyStats = Booking::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentBookings',
            'pendingInstructors',
            'monthlyStats'
        ));
    }
}