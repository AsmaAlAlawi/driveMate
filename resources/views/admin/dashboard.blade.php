@extends('layouts.app')

@section('title', 'لوحة التحكم - الأدمن')

@push('styles')
<style>
    body {
        background: #F5F1EB;
    }

    /* Page spacing under navbar */
.page-content {
    margin-top: 2.5rem;
}


    .page-title {
        color: #6D1B2D;
    }

    .role-badge {
        background: #6D1B2D !important;
        color: #fff;
        opacity: 0.9;
    }

    .admin-card {
        background: rgba(255,255,255,0.82);
        backdrop-filter: blur(10px);
        border: 1px solid #e6dfd6;
    }

    .card-header-purple {
        background: #6D1B2D !important;
        color: #fff !important;
    }

    .card-header-yellow {
        background: #6D1B2D !important;
        color: #000 !important;
    }

    .card-header-blue {
        background: #6D1B2D !important;
        color: #fff !important;
    }

    .stat-card {
        border: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }

    .stat-card-purple {
        background: linear-gradient(135deg, #6D1B2D 0%, #3c0b1a 100%);
    }

    .stat-card-green {
        background: linear-gradient(135deg, #6D1B2D 0%, #9b2b3a 100%);
    }

    .stat-card-yellow {
        background: linear-gradient(135deg, #6D1B2D 0%, #3c0b1a 100%);
    }

    .stat-card-blue {
        background: rgba(255,255,255,0.8);;
    }

    .stat-title {
        color: rgba(255,255,255,0.8);
        font-size: 14px;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
    }

    .stat-icon {
        font-size: 48px;
        opacity: 0.55;
    }

    .stat-icon-yellow {
        font-size: 36px;
        color: #f1c40f;
    }

    .stat-icon-green {
        font-size: 36px;
        color: #6D1B2D;
    }

    .stat-icon-blue {
        font-size: 36px;
        color: rgba(255,255,255,0.8);
    }

    .revenue-card {
        border: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        background: linear-gradient(135deg, #6D1B2D 0%, #9b2b3a 100%);
    }

    .revenue-title {
        color: rgba(255,255,255,0.8);
        font-size: 16px;
    }

    .revenue-number {
        font-size: 40px;
        font-weight: 800;
        color: #fff;
    }

    .revenue-icon {
        font-size: 64px;
        opacity: 0.55;
        color: #fff;
    }

    .btn-primary {
        background-color: #6D1B2D !important;
        border-color: #6D1B2D !important;
    }

    .btn-primary:hover {
        background-color: #581525 !important;
        border-color: #581525 !important;
    }

    .btn-secondary {
        background-color: #6D1B2D !important;
        border-color: #6D1B2D !important;
        opacity: 0.85;
    }

    .btn-secondary:hover {
        opacity: 1;
        background-color: #581525 !important;
        border-color: #581525 !important;
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</h1>
        <span class="badge role-badge">أدمن</span>
    </div>

    <!-- الإحصائيات -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title">المتدربين</h6>
                            <h2 class="stat-number">{{ $stats['total_students'] }}</h2>
                        </div>
                        <i class="fas fa-users stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-green">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title">المدربين النشطين</h6>
                            <h2 class="stat-number">{{ $stats['active_instructors'] }}</h2>
                        </div>
                        <i class="fas fa-user-check stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-yellow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title">في انتظار الموافقة</h6>
                            <h2 class="stat-number">{{ $stats['pending_instructors'] }}</h2>
                        </div>
                        <i class="fas fa-hourglass-half stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-blue">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title">إجمالي الحجوزات</h6>
                            <h2 class="stat-number">{{ $stats['total_bookings'] }}</h2>
                        </div>
                        <i class="fas fa-calendar-check stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- إحصائيات الحجوزات -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card admin-card">
                <div class="card-body text-center">
                    <i class="fas fa-clock stat-icon-yellow mb-2"></i>
                    <h4 class="mb-0">{{ $stats['pending_bookings'] }}</h4>
                    <small class="text-muted">حجوزات في انتظار الدفع</small>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card admin-card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle stat-icon-green mb-2"></i>
                    <h4 class="mb-0">{{ $stats['confirmed_bookings'] }}</h4>
                    <small class="text-muted">حجوزات مؤكدة</small>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card admin-card">
                <div class="card-body text-center">
                    <i class="fas fa-trophy stat-icon-blue mb-2"></i>
                    <h4 class="mb-0">{{ $stats['completed_bookings'] }}</h4>
                    <small class="text-muted">حجوزات مكتملة</small>
                </div>
            </div>
        </div>
    </div>

    <!-- إجمالي الإيرادات -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card revenue-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="revenue-title">إجمالي الإيرادات</h5>
                            <h1 class="revenue-number">{{ number_format($stats['total_revenue'], 3) }} ر.ع</h1>
                        </div>
                        <div class="col-md-4 text-end">
                            <i class="fas fa-money-bill-wave revenue-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- روابط سريعة -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card admin-card">
                <div class="card-header card-header-purple">
                    <h5 class="mb-0"><i class="fas fa-link"></i> روابط سريعة</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('admin.instructors.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-user-tie"></i> إدارة المدربين
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-calendar"></i> إدارة الحجوزات
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('admin.instructors.index', ['status' => 'pending']) }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-user-clock"></i> طلبات الانضمام
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('instructors.index') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-eye"></i> عرض الموقع
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- المدربين في انتظار الموافقة -->
    @if($pendingInstructors->count() > 0)
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card admin-card">
                <div class="card-header card-header-yellow">
                    <h5 class="mb-0">
                        <i class="fas fa-user-clock"></i> مدربين في انتظار الموافقة ({{ $pendingInstructors->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>المنطقة</th>
                                    <th>الهاتف</th>
                                    <th>سنوات الخبرة</th>
                                    <th>تاريخ التسجيل</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingInstructors as $instructor)
                                    <tr>
                                        <td>{{ $instructor->full_name }}</td>
                                        <td>{{ $instructor->user->email }}</td>
                                        <td>{{ $instructor->region->name }}</td>
                                        <td>{{ $instructor->phone }}</td>
                                        <td>{{ $instructor->years_experience }} سنة</td>
                                        <td>{{ $instructor->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('admin.instructors.show', $instructor) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.instructors.approve', $instructor) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('تفعيل هذا المدرب؟')">
                                                    <i class="fas fa-check"></i> موافقة
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.instructors.reject', $instructor) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('رفض هذا المدرب؟')">
                                                    <i class="fas fa-times"></i> رفض
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- أحدث الحجوزات -->
    <div class="row">
        <div class="col-md-12">
            <div class="card admin-card">
                <div class="card-header card-header-blue">
                    <h5 class="mb-0"><i class="fas fa-clock"></i> أحدث الحجوزات</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>المتدرب</th>
                                    <th>المدرب</th>
                                    <th>التاريخ</th>
                                    <th>المبلغ</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->student->name }}</td>
                                        <td>{{ $booking->instructor->full_name }}</td>
                                        <td>{{ $booking->booking_date->format('Y-m-d') }}</td>
                                        <td class="fw-bold text-success">{{ number_format($booking->total_price, 3) }} ر.ع</td>
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
                                            <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> عرض
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">لا توجد حجوزات بعد</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection