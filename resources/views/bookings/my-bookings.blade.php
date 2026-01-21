@extends('layouts.app')

@section('title', 'حجوزاتي')



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


h1, h2, h3, h4, h5 {
    color: #7b1e3a; /* عنابي فخم */
    font-weight: 700;
}

.bg-placeholder {
    background-color: #f5f1eb !important; /* بيج */
    color: #7b1e3a !important;             /* أيقونة عنابية */
    border: 1px solid #e2d6c8;
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
    background: transparent;
    border-bottom: 1px solid #f0e6ea;
    font-weight: 600;
}

/* =====================
   الفلتر (أزرار الحالات)
===================== */
.btn-group .btn {
    border-radius: 30px !important;
    border: 1px solid #7b1e3a;
    color: #7b1e3a;
    background-color: transparent;
    font-weight: 500;
    padding: 8px 20px;
    transition: all .25s ease;
}

.btn-group .btn:hover,
.btn-group .btn.active {
    background-color: #7b1e3a !important;
    color: #fff !important;
    border-color: #7b1e3a !important;
}

/* =====================
   الأزرار (الأساسية بيج)
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

/* زر الإلغاء */
.btn-danger {
    background-color: #8f1d35 !important;
    border-color: #8f1d35 !important;
    color: #fff !important;
}

.btn-danger:hover {
    background-color: #6f1629 !important;
    color: #fff !important;
}

/* =====================
   إزالة أي أثر Bootstrap
===================== */
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

/* =====================
   أيقونات
===================== */
i.fas,
i.fa,
.card-body i,
.text-primary {
    color: #7b1e3a !important; /* كل الأيقونات عنابية */
}

/* =====================
   حالة في انتظار الدفع
===================== */
.badge-status.bg-warning {
    background-color: #f5f1eb !important;
    color: #7b1e3a !important;
    border: 1px solid #e2d6c8;
    font-weight: 600;
}

/* =====================
   توزيع الأزرار داخل الكرت
===================== */
.flex-fill {
    flex: 1 1 0;
}

.card .btn {
    white-space: nowrap;
}


</style>
@endpush

@section('content')
<h1 class="mb-4"><i class="fas fa-calendar"></i> حجوزاتي</h1>

@if($bookings->count() > 0)
    <div class="row">
        @foreach($bookings as $booking)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong>حجز #{{ $booking->id }}</strong>
                        @if($booking->status == 'pending')
                            <span class="badge badge-status bg-warning">في انتظار الدفع</span>
                        @elseif($booking->status == 'confirmed')
                            <span class="badge badge-status bg-success">مؤكد</span>
                        @elseif($booking->status == 'completed')
                            <span class="badge badge-status bg-info">مكتمل</span>
                        @else
                            <span class="badge badge-status bg-danger">ملغي</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            @if($booking->instructor->photo)
                                <img src="{{ asset('storage/' . $booking->instructor->photo) }}" 
                                     class="rounded-circle me-3" 
                                     style="width: 60px; height: 60px; object-fit: cover;"
                                     alt="{{ $booking->instructor->full_name }}">
                            @else
                            <div class="rounded-circle bg-placeholder text-white d-flex align-items-center justify-content-center me-3" 
                                      style="width: 60px; height: 60px;">
                                        <i class="fas fa-user fa-2x"></i>
                                </div>
                            @endif
                            
                            <div>
                                <h5 class="mb-0">{{ $booking->instructor->full_name }}</h5>
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> {{ $booking->instructor->region->name }}
                                </small>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <p class="mb-2">
                            <i class="fas fa-calendar text-primary"></i>
                            <strong>التاريخ:</strong> 
                            {{ $booking->booking_date->format('Y-m-d') }}
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-clock text-primary"></i>
                            <strong>الوقت:</strong> 
                            {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - 
                            {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-hourglass-half text-primary"></i>
                            <strong>المدة:</strong> 
                            {{ $booking->duration_hours }} ساعة
                        </p>
                        <p class="mb-3">
                            <i class="fas fa-money-bill text-primary"></i>
                            <strong>السعر:</strong> 
                            <span class="text-success fw-bold">{{ number_format($booking->total_price, 3) }} ر.ع</span>
                        </p>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('bookings.show', $booking) }}" class="btn btn-info btn-sm flex-fill">
                                <i class="fas fa-eye"></i> التفاصيل
                            </a>
                            
                            @if($booking->status == 'pending')
                                <a href="{{ route('payment.checkout', $booking) }}" class="btn btn-success btn-sm flex-fill">
                                    <i class="fas fa-credit-card"></i> إكمال الدفع
                                </a>
                            @endif
                            
                            @if($booking->canBeCancelled())
                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="flex-fill">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm w-100" 
                                            onclick="return confirm('هل أنت متأكد من إلغاء الحجز؟')">
                                        <i class="fas fa-times"></i> إلغاء
                                    </button>
                                </form>
                            @endif
                            
                            @if($booking->canBeReviewed())
                                <a href="{{ route('reviews.create', $booking) }}" class="btn btn-warning btn-sm flex-fill">
                                    <i class="fas fa-star"></i> تقييم
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $bookings->links() }}
    </div>
@else
    <div class="alert alert-info text-center">
        <i class="fas fa-info-circle fa-3x mb-3"></i>
        <h4>لا توجد حجوزات بعد</h4>
        <p>ابدأ الآن بحجز أول حصة تدريبية!</p>
        <a href="{{ route('instructors.index') }}" class="btn btn-primary">
            <i class="fas fa-search"></i> ابحث عن مدرب
        </a>
    </div>
@endif
@endsection