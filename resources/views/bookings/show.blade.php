@extends('layouts.app')

@section('title', 'تفاصيل الحجز #' . $booking->id)

@push('styles')
<style>

/* =====================
   الهوية العامة
===================== */
body {
    background-color: #f5f1eb; /* بيج هادئ */
}

/* Page spacing under navbar */
.page-content {
    margin-top: 2.5rem;
}


h1, h2, h3, h5 {
    color: #7b1e3a; /* عنابي فخم */
    font-weight: 700;
}

h4{
    color: #f5f1eb;
    font-weight: 700;
}
/* =====================
   الكروت
===================== */
.card {
    background: #fffdf9;
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: transform .25s ease, box-shadow .25s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.12);
}

.card-header {
    background: #7b1e3a; /* عنابي */
    color: #fff;
    border-bottom: none;
    font-weight: 600;
}

.card-header .badge {
    background: #f5f1eb !important;
    color: #7b1e3a !important;
    border: 1px solid #e2d6c8 !important;
}

/* =====================
   العناوين داخل الكرت
===================== */
.card-body h5 {
    color: #7b1e3a;
    font-weight: 700;
}

/* =====================
   الأيقونات
===================== */
i.fas,
i.fa,
.text-primary,
.card-body i {
    color: #7b1e3a !important;
}

/* =====================
   الأزرار
===================== */
.btn {
    height: 38px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    background-color: #f5f1eb !important;   /* بيج */
    border-color: #e2d6c8 !important;
    color: #7b1e3a !important;
    transition: all .25s ease;
}

.btn:hover {
    background-color: #e9ded2 !important;
    border-color: #d6c4b2 !important;
    color: #7b1e3a !important;
}

/* زر الإلغاء (عنابي)
   نفس تنسيق الصفحة السابقة */
.btn-danger {
    background-color: #8f1d35 !important;
    border-color: #8f1d35 !important;
    color: #fff !important;
}

.btn-danger:hover {
    background-color: #6f1629 !important;
}

/* زر الإكمال (عنابي) */
.btn-info {
    background-color: #7b1e3a !important;
    border-color: #7b1e3a !important;
    color: #fff !important;
}

.btn-info:hover {
    background-color: #64162f !important;
    border-color: #64162f !important;
}

/* زر الدفع بيج */
.btn-success {
    background-color: #f5f1eb !important;
    border-color: #e2d6c8 !important;
    color: #7b1e3a !important;
}

.btn-success:hover {
    background-color: #e9ded2 !important;
    border-color: #d6c4b2 !important;
}

/* إزالة أي أثر Bootstrap */
.btn:focus,
.btn:active,
.btn:focus-visible,
a.btn:focus,
a.btn:active,
button.btn:focus,
button.btn:active {
    outline: none !important;
    box-shadow: none !important;
}

/* الأيقونات داخل الأزرار */
.btn i {
    color: inherit !important;
}

/* =====================
   حالة الدفع داخل الكرت
===================== */
.badge.bg-warning {
    background-color: #f5f1eb !important;
    color: #7b1e3a !important;
    border: 1px solid #e2d6c8 !important;
}

.badge.bg-success {
    background-color: #7b1e3a !important;
    color: #fff !important;
}

.badge.bg-danger {
    background-color: #8f1d35 !important;
    color: #fff !important;
}

.badge.bg-info {
    background-color: #7b1e3a !important;
    color: #fff !important;
}

/* =====================
   تنسيق الصورة الافتراضية
===================== */
.img-placeholder {
    background-color: #f5f1eb !important;
    color: #7b1e3a !important;
    border: 1px solid #e2d6c8;
}


</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-receipt"></i> تفاصيل الحجز #{{ $booking->id }}
                </h4>
                @if($booking->status == 'pending')
                    <span class="badge bg-warning">في انتظار الدفع</span>
                @elseif($booking->status == 'confirmed')
                    <span class="badge bg-success">مؤكد</span>
                @elseif($booking->status == 'completed')
                    <span class="badge bg-info">مكتمل</span>
                @else
                    <span class="badge bg-danger">ملغي</span>
                @endif
            </div>
            <div class="card-body">
                <!-- معلومات المدرب -->
                <h5 class="border-bottom pb-2 mb-3">
                    <i class="fas fa-user-tie text-primary"></i> معلومات المدرب
                </h5>
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        @if($booking->instructor->photo)
                            <img src="{{ asset('storage/' . $booking->instructor->photo) }}" 
                                 class="img-fluid rounded-circle mb-2" 
                                 style="width: 100px; height: 100px; object-fit: cover;"
                                 alt="{{ $booking->instructor->full_name }}">
                        @else
                            <div class="rounded-circle img-placeholder d-inline-flex align-items-center justify-content-center mb-2" 
                                 style="width: 100px; height: 100px;">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h5>{{ $booking->instructor->full_name }}</h5>
                        <p class="mb-1">
                            <i class="fas fa-map-marker-alt text-primary"></i> 
                            {{ $booking->instructor->region->name }}
                        </p>
                        <p class="mb-1">
                            <i class="fas fa-phone text-primary"></i> 
                            {{ $booking->instructor->phone }}
                        </p>
                        <div class="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $booking->instructor->average_rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                            <span class="text-muted">({{ $booking->instructor->total_reviews }})</span>
                        </div>
                    </div>
                </div>
                
                <!-- تفاصيل الحجز -->
                <h5 class="border-bottom pb-2 mb-3">
                    <i class="fas fa-calendar-check text-primary"></i> تفاصيل الموعد
                </h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>التاريخ:</strong> {{ $booking->booking_date->format('Y-m-d') }}</p>
                        <p><strong>اليوم:</strong> {{ $booking->booking_date->locale('ar')->translatedFormat('l') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <strong>الوقت:</strong> 
                            {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - 
                            {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                        </p>
                        <p><strong>المدة:</strong> {{ $booking->duration_hours }} ساعة</p>
                    </div>
                </div>
                
                @if($booking->student_notes)
                    <div class="alert alert-info">
                        <strong><i class="fas fa-sticky-note"></i> ملاحظاتك:</strong>
                        <p class="mb-0 mt-2">{{ $booking->student_notes }}</p>
                    </div>
                @endif
                
                @if($booking->instructor_notes && Auth::id() == $booking->student_id)
                    <div class="alert alert-warning">
                        <strong><i class="fas fa-comment"></i> ملاحظات المدرب:</strong>
                        <p class="mb-0 mt-2">{{ $booking->instructor_notes }}</p>
                    </div>
                @endif
                
                <!-- معلومات الدفع -->
                <h5 class="border-bottom pb-2 mb-3">
                    <i class="fas fa-money-bill text-primary"></i> معلومات الدفع
                </h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>السعر الإجمالي:</strong> 
                            <span class="text-success fw-bold fs-5">{{ number_format($booking->total_price, 3) }} ر.ع</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>حالة الدفع:</strong>
                            @if($booking->payment)
                                @if($booking->payment->status == 'paid')
                                    <span class="badge bg-success">مدفوع</span>
                                @elseif($booking->payment->status == 'pending')
                                    <span class="badge bg-warning">في انتظار الدفع</span>
                                @elseif($booking->payment->status == 'refunded')
                                    <span class="badge bg-info">مسترد</span>
                                @else
                                    <span class="badge bg-danger">فشل</span>
                                @endif
                            @endif
                        </p>
                    </div>
                </div>
                
                @if($booking->payment && $booking->payment->status == 'paid')
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> 
                        تم الدفع بنجاح بتاريخ {{ $booking->payment->paid_at->format('Y-m-d h:i A') }}
                        @if($booking->payment->payment_reference)
                            <br>رقم المرجع: {{ $booking->payment->payment_reference }}
                        @endif
                    </div>
                @endif
                
                <!-- التقييم -->
                @if($booking->review)
                    <h5 class="border-bottom pb-2 mb-3">
                        <i class="fas fa-star text-primary"></i> التقييم
                    </h5>
                    <div class="alert alert-warning">
                        <div class="rating-stars mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $booking->review->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        @if($booking->review->comment)
                            <p class="mb-0">{{ $booking->review->comment }}</p>
                        @endif
                    </div>
                @endif
                
                <!-- الأزرار -->
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('bookings.my-bookings') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i> العودة للحجوزات
                    </a>
                    
                    @if($booking->status == 'pending' && Auth::id() == $booking->student_id)
                        <a href="{{ route('payment.checkout', $booking) }}" class="btn btn-success">
                            <i class="fas fa-credit-card"></i> إكمال الدفع
                        </a>
                    @endif
                    
                    @if($booking->canBeCancelled() && Auth::id() == $booking->student_id)
                        <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('هل أنت متأكد من إلغاء الحجز؟')">
                                <i class="fas fa-times"></i> إلغاء الحجز
                            </button>
                        </form>
                    @endif
                    
                    @if($booking->status == 'confirmed' && Auth::user()->instructor && Auth::user()->instructor->id == $booking->instructor_id)
                        <form action="{{ route('bookings.complete', $booking) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info" 
                                    onclick="return confirm('هل تم إكمال الحصة التدريبية؟')">
                                <i class="fas fa-check"></i> تأكيد الإكمال
                            </button>
                        </form>
                    @endif
                    
                    @if($booking->canBeReviewed() && Auth::id() == $booking->student_id)
                        <a href="{{ route('reviews.create', $booking) }}" class="btn btn-warning">
                            <i class="fas fa-star"></i> تقييم المدرب
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection