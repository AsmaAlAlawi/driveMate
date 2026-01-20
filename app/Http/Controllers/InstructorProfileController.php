<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InstructorProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCompleteProfile()
    {
        // التحقق من أن المستخدم مدرب
        if (!Auth::user()->isInstructor()) {
            abort(403);
        }

        // إذا كانت البيانات مكتملة، توجيه لصفحة أخرى
        if (Auth::user()->instructor) {
            return redirect()->route('bookings.instructor-bookings');
        }

        $regions = Region::all();
        return view('instructor.complete-profile', compact('regions'));
    }

    public function storeProfile(Request $request)
    {
        if (!Auth::user()->isInstructor()) {
            abort(403);
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'region_id' => 'required|exists:regions,id',
            'license_number' => 'required|string|max:50',
            'years_experience' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // رفع الصورة
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('instructors', 'public');
        }

        // إنشاء حساب المدرب
        Instructor::create([
            'user_id' => Auth::id(),
            'region_id' => $validated['region_id'],
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'license_number' => $validated['license_number'],
            'years_experience' => $validated['years_experience'],
            'hourly_rate' => $validated['hourly_rate'],
            'bio' => $validated['bio'],
            'photo' => $photoPath,
            'status' => 'pending', // في انتظار موافقة الأدمن
        ]);

        return redirect()->route('home')->with('success', 'تم إرسال طلبك بنجاح! سيتم مراجعته من قبل الإدارة.');
    }
}