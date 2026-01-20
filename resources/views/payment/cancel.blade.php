@extends('layouts.app')

@section('title', 'تم إلغاء الدفع')

@push('styles')
<style>
    body {
        background-color: #f5f1eb; /* بيج هادئ */
    }

    /* الكرت */
    .card {
        border-radius: 18px;
        border: none;
        background: #fffdf9;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    /* أيقونة التحذير */
    .warning-icon {
        color: #7b1e3a; /* عنابي */
        opacity: 0.85;
    }

    h2 {
        color: #7b1e3a;
        font-weight: bold;
    }

    /* صندوق المعلومات */
    .alert-info {
        background-color: #f3e6ea;
        border: none;
        border-radius: 14px;
        color: #3a3a3a;
    }

    /* زر إعادة المحاولة */
    .btn-success {
        background-color: #7b1e3a;
        border-color: #7b1e3a;
        border-radius: 30px;
        padding: 10px 22px;
        font-weight: 500;
    }

    .btn-success:hover {
        background-color: #64162f;
        border-color: #64162f;
    }

    /* زر ثانوي */
    .btn-outline-secondary {
        border-radius: 30px;
        padding: 10px 22px;
        font-weight: 500;
    }

    /* نصوص */
    .text-muted {
        font-size: 0.95rem;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body py-5">
             <div class="warning-icon mb-4">
                <i class="fas fa-exclamation-triangle fa-5x"></i>
                    </div>
                <h2 class="mb-3">تم إلغاء عملية الدفع</h2>
                <p class="text-muted mb-4">لم يتم إكمال عملية الدفع. حجزك لا يزال في انتظار الدفع</p>
                
                <div class="alert alert-info text-start">
                    <p class="mb-2"><strong>رقم الحجز:</strong> #{{ $booking->id }}</p>
                    <p class="mb-0">يمكنك إكمال الدفع لاحقاً من صفحة الحجوزات</p>
                </div>
                
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <a href="{{ route('payment.checkout', $booking) }}" class="btn btn-success">
                        <i class="fas fa-redo"></i> إعادة المحاولة
                    </a>
                    <a href="{{ route('bookings.my-bookings') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-calendar"></i> حجوزاتي
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection