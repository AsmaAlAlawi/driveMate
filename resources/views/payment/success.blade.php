@extends('layouts.app')

@section('title', 'تم الدفع بنجاح')

@push('styles')
<style>
    body {
        background-color: #f5f1eb; /* بيج هادئ */
    }

    /* الكرت الرئيسي */
    .card {
        border-radius: 18px;
        border: none;
        background: #fffdf9;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    /* أيقونة النجاح */
    .success-icon {
        color: #7b1e3a; /* عنابي فاخر */
    }

    h2 {
        color: #7b1e3a;
        font-weight: bold;
    }

    /* صندوق تفاصيل الحجز */
    .alert-success {
        background-color: #f3e6ea;
        border: none;
        border-radius: 14px;
        color: #3a3a3a;
    }

    .alert-success h5 {
        color: #7b1e3a;
        font-weight: bold;
    }

    .alert-success hr {
        border-color: rgba(123,30,58,0.2);
    }

    /* السعر */
    .price {
        color: #7b1e3a;
        font-weight: bold;
        font-size: 1.05rem;
    }

    /* الأزرار */
    .btn-primary {
        background-color: #7b1e3a;
        border-color: #7b1e3a;
        border-radius: 30px;
        padding: 10px 20px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #64162f;
        border-color: #64162f;
    }

    .btn-outline-primary {
        border-color: #7b1e3a;
        color: #7b1e3a;
        border-radius: 30px;
        padding: 10px 20px;
        font-weight: 500;
    }

    .btn-outline-primary:hover {
        background-color: #7b1e3a;
        color: #fff;
    }
</style>
@endpush


@section('content')
<div class="success-icon mb-4">
    <i class="fas fa-check-circle fa-5x"></i>
</div>
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body py-5">
                <div class="text-success mb-4">
                    <i class="fas fa-check-circle fa-5x"></i>
                </div>
                
                <h2 class="text-success mb-3">تم الدفع بنجاح!</h2>
                <p class="text-muted mb-4">شكراً لك! تم تأكيد حجزك بنجاح</p>
                
                <div class="alert alert-success text-start">
                    <h5><i class="fas fa-receipt"></i> تفاصيل الحجز</h5>
                    <hr>
                    <p class="mb-2"><strong>رقم الحجز:</strong> #{{ $booking->id }}</p>
                    <p class="mb-2"><strong>المدرب:</strong> {{ $booking->instructor->full_name }}</p>
                    <p class="mb-2"><strong>التاريخ:</strong> {{ $booking->booking_date->format('Y-m-d') }}</p>
                    <p class="mb-2">
                        <strong>الوقت:</strong>
                        {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} -
                        {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                    </p>
                    <p class="mb-0"><strong>المبلغ المدفوع:</strong> 
                    <span class="price">{{ number_format($booking->total_price, 3) }} ر.ع</span>
                    </p>
                </div>
                
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> عرض تفاصيل الحجز
                    </a>
                    <a href="{{ route('instructors.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-home"></i> العودة للرئيسية
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection