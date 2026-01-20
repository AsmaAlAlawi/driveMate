<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InstructorManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $instructors = Instructor::with(['user', 'region'])
            ->withCount(['bookings', 'reviews'])
            ->latest()
            ->paginate(20);

        return view('admin.instructors.index', compact('instructors'));
    }

    public function show(Instructor $instructor)
    {
        $instructor->load(['user', 'region', 'bookings.student', 'reviews.student']);
        
        return view('admin.instructors.show', compact('instructor'));
    }

    public function approve(Instructor $instructor)
    {
        $instructor->update(['status' => 'active']);

        return redirect()->back()->with('success', 'تم تفعيل حساب المدرب بنجاح');
    }

    public function reject(Instructor $instructor)
    {
        $instructor->update(['status' => 'inactive']);

        return redirect()->back()->with('success', 'تم رفض/إيقاف حساب المدرب');
    }

    public function destroy(Instructor $instructor)
    {
        DB::beginTransaction();
        try {
            $user = $instructor->user;
            $instructor->delete();
            $user->delete();

            DB::commit();
            return redirect()->route('admin.instructors.index')
                ->with('success', 'تم حذف المدرب بنجاح');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'حدث خطأ أثناء الحذف');
        }
    }
}