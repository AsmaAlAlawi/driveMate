<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Region;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // احصائيات للصفحة الرئيسية
        $totalInstructors = Instructor::where('status', 'active')->count();
        $regions = Region::withCount('instructors')->get();
        $topInstructors = Instructor::where('status', 'active')
            ->orderBy('average_rating', 'desc')
            ->take(6)
            ->get();

        return view('home', compact('totalInstructors', 'regions', 'topInstructors'));
    }

    public function search(Request $request)
    {
        $query = Instructor::where('status', 'active');

        // فلترة حسب المنطقة
        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        // فلترة حسب السعر
        if ($request->filled('min_price')) {
            $query->where('hourly_rate', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('hourly_rate', '<=', $request->max_price);
        }

        // فلترة حسب التقييم
        if ($request->filled('min_rating')) {
            $query->where('average_rating', '>=', $request->min_rating);
        }

        // الترتيب
        $sortBy = $request->get('sort_by', 'average_rating');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $instructors = $query->with(['region', 'user'])->paginate(12);
        $regions = Region::all();

        return view('instructors.search', compact('instructors', 'regions'));
    }
}