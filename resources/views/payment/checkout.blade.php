@extends('layouts.app')

@section('title', 'إتمام الدفع')

@push('styles')
<style>
    body {
        background-color: #f5f1eb; /* بيج هادئ */
    }

        /* Page spacing under navbar */
.page-content {
    margin-top: 2.5rem;
}

    /* الكرت */
    .card {
        border-radius: 18px;
        border: none;
        background: #fffdf9;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    /* الهيدر */
    .card-header {
        background-color: #7b1e3a !important; /* عنابي */
        color: #fff;
        border-radius: 18px 18px 0 0;
    }

    /* العناوين */
    h4, h5 {
        color: #7b1e3a;
        font-weight: bold;
    }

    /* أيقونة الأمان */
    .secure-icon {
        color: #7b1e3a;
    }

    /* السعر */
    .total-price {
        color: #7b1e3a;
        font-weight: bold;
        font-size: 1.7rem;
    }

    /* زر الدفع */
    .btn-success {
        background-color: #7b1e3a;
        border-color: #7b1e3a;
        border-radius: 30px;
        padding: 14px;
        font-size: 1.05rem;
        font-weight: 500;
    }

    .btn-success:hover {
        background-color: #64162f;
        border-color: #64162f;
    }

    /* رابط الإلغاء */
    .btn-link {
        color: #7b1e3a;
        font-weight: 500;
    }

    .btn-link:hover {
        text-decoration: underline;
        color: #64162f;
    }

    /* صندوق المعلومة */
    .alert-info {
        background-color: #f3e6ea;
        border: none;
        border-radius: 14px;
        color: #3a3a3a;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white text-center">
                <h4 class="mb-0">
                    <i class="fas fa-credit-card"></i> إتمام الدفع
                </h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                <i class="fas fa-lock fa-3x secure-icon mb-3"></i>
                    <p class="text-muted">دفع آمن عبر بوابة ثواني</p>
                </div>
                
                <h5 class="border-bottom pb-2 mb-3">ملخص الحجز</h5>
                
                <div class="mb-3">
                    <strong>المدرب:</strong> {{ $booking->instructor->full_name }}
                </div>
                <div class="mb-3">
                    <strong>التاريخ:</strong> {{ $booking->booking_date->format('Y-m-d') }}
                </div>
                <div class="mb-3">
                    <strong>الوقت:</strong>
                    {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} -
                    {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                </div>
                <div class="mb-3">
                    <strong>المدة:</strong> {{ $booking->duration_hours }} ساعة
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">المبلغ الإجمالي:</h4>
                    <h3 class="mb-0 total-price">{{ number_format($booking->total_price, 3) }} ر.ع</h3>
                </div>
                
                <form action="{{ route('payment.process', $booking) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg w-100">
                        <i class="fas fa-lock"></i> الدفع عبر ثواني
                    </button>
                </form>
                
                <div class="text-center mt-3">
                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-link">
                        إلغاء
                    </a>
                </div>
                
                <div class="alert alert-info mt-4">
                    <small>
                        <i class="fas fa-info-circle"></i>
                        سيتم تحويلك إلى صفحة الدفع الآمنة من ثواني لإكمال العملية
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection