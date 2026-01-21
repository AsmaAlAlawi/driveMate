@extends('layouts.app')

@section('title', 'إدارة الحجوزات')

@push('styles')
<style>
    :root {
        --burgundy: #6D1B2D;
        --burgundy-dark: #581624;
        --beige: #F6F1EB;
        --soft-white: rgba(255, 255, 255, 0.88);
    }

    body {
        background-color: var(--beige);
        font-family: 'Cairo', sans-serif;
    }

    /* Page spacing under navbar */
.page-content {
    margin-top: 2.5rem;
}


    /* العناوين */
    .page-title {
        color: var(--burgundy);
        font-weight: 800;
    }

    /* الكروت */
    .soft-card {
        background: var(--soft-white);
        backdrop-filter: blur(12px);
        border-radius: 18px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.06);
        border: none;
    }

    /* الأزرار */
    .btn-burgundy {
        background-color: var(--burgundy);
        color: #fff;
        border: none;
        border-radius: 12px;
    }

    .btn-burgundy:hover {
        background-color: var(--burgundy-dark);
        color: #fff;
    }

    /* الفلاتر */
    .filter-label {
        color: var(--burgundy);
        font-weight: 600;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        border: 1px solid #eee;
    }

    /* الجدول */
    .table thead {
        background-color: var(--burgundy);
        color: #fff;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(109, 27, 45, 0.05);
    }

    /* البادجات */
    .badge {
        border-radius: 8px;
        font-weight: 600;
        padding: 6px 10px;
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    <!-- العنوان -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title">
            <i class="fas fa-calendar-check"></i> إدارة الحجوزات
        </h1>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-burgundy">
            <i class="fas fa-arrow-right"></i> العودة للوحة التحكم
        </a>
    </div>

    <!-- فلاتر -->
    <div class="card mb-4 soft-card">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.bookings.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label filter-label">الحالة</label>
                        <select name="status" class="form-select">
                            <option value="">الكل</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>في انتظار الدفع</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label filter-label">من تاريخ</label>
                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label filter-label">إلى تاريخ</label>
                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-burgundy w-100">
                            <i class="fas fa-search"></i> بحث
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- جدول الحجوزات -->
    <div class="card soft-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>المتدرب</th>
                            <th>المدرب</th>
                            <th>التاريخ</th>
                            <th>الوقت</th>
                            <th>المبلغ</th>
                            <th>الحالة</th>
                            <th>الدفع</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>
                                    <strong>{{ $booking->student->name }}</strong><br>
                                    <small class="text-muted">{{ $booking->student->email }}</small>
                                </td>
                                <td>{{ $booking->instructor->full_name }}</td>
                                <td>{{ $booking->booking_date->format('Y-m-d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }}</td>
                                <td class="fw-bold text-success">
                                    {{ number_format($booking->total_price, 3) }} ر.ع
                                </td>
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
                                    @if($booking->payment)
                                        @if($booking->payment->status == 'paid')
                                            <span class="badge bg-success">مدفوع</span>
                                        @elseif($booking->payment->status == 'pending')
                                            <span class="badge bg-warning">معلق</span>
                                        @else
                                            <span class="badge bg-danger">فشل</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">—</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> عرض
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    لا توجد حجوزات
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $bookings->appends(request()->query())->links() }}
    </div>

</div>
@endsection
