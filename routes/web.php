<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InstructorProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstructorManagementController;
use App\Http\Controllers\Admin\BookingManagementController;
use App\Http\Controllers\PageController;


// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// البحث عن المدربين
Route::get('/search', [HomeController::class, 'search'])->name('instructors.search');

// المدربين
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors.index');
Route::get('/instructors/{instructor}', [InstructorController::class, 'show'])->name('instructors.show');
Route::post('/instructors/{instructor}/check-availability', [InstructorController::class, 'checkAvailability'])
    ->name('instructors.check-availability');

// الحجوزات (تحتاج تسجيل دخول)
Route::middleware('auth')->group(function () {
    // إنشاء حجز
    Route::get('/instructors/{instructor}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    
    // عرض وإدارة الحجوزات
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my-bookings');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    
    // حجوزات المدرب
    Route::get('/instructor/bookings', [BookingController::class, 'instructorBookings'])
        ->name('bookings.instructor-bookings');
    Route::post('/bookings/{booking}/complete', [BookingController::class, 'complete'])
        ->name('bookings.complete');

    // التقييمات
    Route::get('/bookings/{booking}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/bookings/{booking}/review', [ReviewController::class, 'store'])->name('reviews.store');

    // الدفع
    Route::get('/payment/{booking}/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/payment/{booking}/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
    
    // مسارات المدرب
    Route::get('/instructor/complete-profile', [InstructorProfileController::class, 'showCompleteProfile'])
        ->name('instructor.complete-profile');
    Route::post('/instructor/complete-profile', [InstructorProfileController::class, 'storeProfile'])
        ->name('instructor.store-profile');
});

// لوحة تحكم الأدمن
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () 
{
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // إدارة المدربين
    Route::get('/instructors', [InstructorManagementController::class, 'index'])->name('instructors.index');
    Route::get('/instructors/{instructor}', [InstructorManagementController::class, 'show'])->name('instructors.show');
    Route::post('/instructors/{instructor}/approve', [InstructorManagementController::class, 'approve'])
        ->name('instructors.approve');
    Route::post('/instructors/{instructor}/reject', [InstructorManagementController::class, 'reject'])
        ->name('instructors.reject');
    Route::delete('/instructors/{instructor}', [InstructorManagementController::class, 'destroy'])
        ->name('instructors.destroy');
    
    // إدارة الحجوزات
    Route::get('/bookings', [BookingManagementController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingManagementController::class, 'show'])->name('bookings.show');
});


Route::get('/about', function () {
    return view('about');})->name('about');

Route::get('/contact', function () {
    return view('contact');})->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // الحجوزات هنا
});


// صفحات ثابتة
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [PageController::class, 'terms'])->name('terms');

require __DIR__.'/auth.php';