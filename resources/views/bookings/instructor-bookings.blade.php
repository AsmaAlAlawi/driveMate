@extends('layouts.app')

@section('title', 'حجوزاتي كمدرب')

@push('styles')
<style>
    body {
        background-color: #f5f1eb; /* بيج هادئ */
    }

    h1 {
        color: #7b1e3a; /* عنابي فاخر */
        font-weight: bold;
    }

    /* الكروت */
    .card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        background: #fffdf9;
    }

    /* أزرار الفلترة */
    .btn-outline-primary,
    .btn-outline-warning,
    .btn-outline-success,
    .btn-outline-info {
        border-radius: 30px;
        padding: 8px 18px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-group .btn.active,
    .btn-group .btn:hover {
        background-color: #7b1e3a !important;
        border-color: #7b1e3a !important;
        color: #fff !important;
    }

    /* إزالة اللون الأزرق و الـ outline من جميع الأزرار */
.btn:focus,
.btn:active,
.btn:focus-visible,
.btn.active {
    outline: none !important;
    box-shadow: none !important;
}

/* إزالة التأثير من روابط الأزرار */
a.btn:focus,
a.btn:active,
a.btn:focus-visible {
    outline: none !important;
    box-shadow: none !important;
}

/* الأيقونات داخل الأزرار */
.btn i {
    pointer-events: none;
}

/* أزرار الإجراءات (العين + إكمال) */
.btn-info:focus,
.btn-info:active,
.btn-success:focus,
.btn-success:active {
    box-shadow: none !important;
}

/* أزرار الفلاتر */
.btn-outline-primary:focus,
.btn-outline-warning:focus,
.btn-outline-success:focus,
.btn-outline-info:focus {
    box-shadow: none !important;
}




    /* الجدول */
    .table {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
    }

    .table thead {
        background-color: #7b1e3a;
        color: #fff;
    }

    .table-hover tbody tr:hover {
        background-color: #f3e6ea;
    }

    /* السعر */
    .price {
        color: #7b1e3a;
        font-weight: bold;
    }

    /* البادجات */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    /* أزرار الإجراءات */
    .btn-info {
        background-color: #7b1e3a;
        border-color: #7b1e3a;
        color: #fff;
    }

    .btn-info:hover {
        background-color: #64162f;
        border-color: #64162f;
    }

    .btn-success {
        border-radius: 20px;
    }

    /* التنبيه */
    .alert-info {
        background-color: #fff;
        border: none;
        border-radius: 16px;
        color: #7b1e3a;
        box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    }
</style>
@endpush


@section('content')
<h1 class="mb-4"><i class="fas fa-calendar-check"></i> حجوزاتي كمدرب</h1>

<!-- فلاتر -->
<div class="card mb-4">
    <div class="card-body">
        <div class="btn-group" role="group">
            <a href="?status=all" class="btn btn-outline-primary {{ request('status', 'all') == 'all' ? 'active' : '' }}">
                الكل
            </a>
            <a href="?status=pending" class="btn btn-outline-warning {{ request('status') == 'pending' ? 'active' : '' }}">
                في انتظار الدفع
            </a>
            <a href="?status=confirmed" class="btn btn-outline-success {{ request('status') == 'confirmed' ? 'active' : '' }}">
                مؤكدة
            </a>
            <a href="?status=completed" class="btn btn-outline-info {{ request('status') == 'completed' ? 'active' : '' }}">
                مكتملة
            </a>
        </div>
    </div>
</div>

@if($bookings->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>المتدرب</th>
                    <th>التاريخ</th>
                    <th>الوقت</th>
                    <th>المدة</th>
                    <th>السعر</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>
                            <strong>{{ $booking->student->name }}</strong><br>
                            <small class="text-muted">{{ $booking->student->email }}</small>
                        </td>
                        <td>{{ $booking->booking_date->format('Y-m-d') }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} -
                            {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                        </td>
                        <td>{{ $booking->duration_hours }} ساعة</td>
                        <td class="price">{{ number_format($booking->total_price, 3) }} ر.ع</td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge bg-warning">في انتظار الدفع</span>
                            @elseif($booking->status == 'confirmed')
                                <span class="badge bg-success">مؤكد</span>
                            @elseif($booking->status == 'completed')
                                <span class="badge bg-info">مكتمل</span>
                            @else
                                <span class="badge bg-danger">ملغي</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($booking->status == 'confirmed')
                                <form action="{{ route('bookings.complete', $booking) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" 
                                            onclick="return confirm('هل تم إكمال الحصة؟')">
                                        <i class="fas fa-check"></i> إكمال
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $bookings->links() }}
    </div>
@else
    <div class="alert alert-info text-center">
        <i class="fas fa-info-circle fa-3x mb-3"></i>
        <h4>لا توجد حجوزات</h4>
    </div>
@endif
@endsection