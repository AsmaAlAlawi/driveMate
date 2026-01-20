@extends('layouts.app')

@section('title', 'تفاصيل المدرب - ' . $instructor->full_name)

@push('styles')
<style>
    body {
        background: #F5F1EB;
    }

    .admin-card {
        background: rgba(255,255,255,0.82);
        backdrop-filter: blur(10px);
        border: 1px solid #e6dfd6;
    }

    h1 {
        color: #6D1B2D;
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
        <h1 class="text-[#6D1B2D]"><i class="fas fa-user-tie"></i> تفاصيل المدرب</h1>
        <a href="{{ route('admin.instructors.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right"></i> العودة
        </a>
    </div>

    <div class="row">
        <!-- معلومات المدرب -->
        <div class="col-md-4 mb-4">
            <div class="card admin-card">
                <div class="card-body text-center">
                    @if($instructor->photo)
                        <img src="{{ asset('storage/' . $instructor->photo) }}"
                             class="img-fluid rounded-circle mb-3"
                             style="width: 150px; height: 150px; object-fit: cover;"
                             alt="{{ $instructor->full_name }}">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 150px; height: 150px;">
                            <i class="fas fa-user fa-4x"></i>
                        </div>
                    @endif

                    <h3>{{ $instructor->full_name }}</h3>

                    @if($instructor->status == 'active')
                        <span class="badge bg-success mb-3">نشط</span>
                    @elseif($instructor->status == 'pending')
                        <span class="badge bg-warning mb-3">في الانتظار</span>
                    @else
                        <span class="badge bg-danger mb-3">غير نشط</span>
                    @endif

                    <hr>

                    <div class="text-start">
                        <p><strong>البريد الإلكتروني:</strong><br>{{ $instructor->user->email }}</p>
                        <p><strong>الهاتف:</strong><br>{{ $instructor->phone }}</p>
                        <p><strong>المنطقة:</strong><br>{{ $instructor->region->name }}</p>
                        <p><strong>رقم الرخصة:</strong><br>{{ $instructor->license_number }}</p>
                        <p><strong>سنوات الخبرة:</strong><br>{{ $instructor->years_experience }} سنة</p>
                        <p><strong>السعر/ساعة:</strong><br>
                            <span class="text-success fw-bold">{{ number_format($instructor->hourly_rate, 3) }} ر.ع</span>
                        </p>
                    </div>

                    <hr>

                    <!-- إحصائيات -->
                    <div class="row text-center">
                        <div class="col-4">
                            <h4 class="text-primary">{{ $instructor->total_bookings }}</h4>
                            <small class="text-muted">حجز</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-warning">{{ number_format($instructor->average_rating, 1) }}</h4>
                            <small class="text-muted">تقييم</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-info">{{ $instructor->total_reviews }}</h4>
                            <small class="text-muted">مراجعة</small>
                        </div>
                    </div>

                    <hr>

                    <!-- أزرار الإجراءات -->
                    <div class="d-grid gap-2">
                        @if($instructor->status == 'pending')
                            <form action="{{ route('admin.instructors.approve', $instructor) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check"></i> الموافقة على التفعيل
                                </button>
                            </form>
                            <form action="{{ route('admin.instructors.reject', $instructor) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-times"></i> رفض الطلب
                                </button>
                            </form>
                        @elseif($instructor->status == 'active')
                            <form action="{{ route('admin.instructors.reject', $instructor) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="fas fa-ban"></i> إيقاف الحساب
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.instructors.approve', $instructor) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check"></i> إعادة التفعيل
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.instructors.destroy', $instructor) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا المدرب نهائياً؟')">
                                <i class="fas fa-trash"></i> حذف نهائي
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- التفاصيل الإضافية -->
        <div class="col-md-8">
            <!-- نبذة -->
            @if($instructor->bio)
                <div class="card mb-4 admin-card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> نبذة</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $instructor->bio }}</p>
                    </div>
                </div>
            @endif

            <!-- الحجوزات -->
            <div class="card mb-4 admin-card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar"></i> الحجوزات</h5>
                </div>
                <div class="card-body">
                    @if($instructor->bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>المتدرب</th>
                                        <th>التاريخ</th>
                                        <th>المبلغ</th>
                                        <th>الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($instructor->bookings->take(10) as $booking)
                                        <tr>
                                            <td>{{ $booking->id }}</td>
                                            <td>{{ $booking->student->name }}</td>
                                            <td>{{ $booking->booking_date->format('Y-m-d') }}</td>
                                            <td>{{ number_format($booking->total_price, 3) }} ر.ع</td>
                                            <td>
                                                @if($booking->status == 'completed')
                                                    <span class="badge bg-success">مكتمل</span>
                                                @elseif($booking->status == 'confirmed')
                                                    <span class="badge bg-info">مؤكد</span>
                                                @elseif($booking->status == 'pending')
                                                    <span class="badge bg-warning">في الانتظار</span>
                                                @else
                                                    <span class="badge bg-danger">ملغي</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center">لا توجد حجوزات بعد</p>
                    @endif
                </div>
            </div>

            <!-- التقييمات -->
            <div class="card admin-card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-star"></i> التقييمات</h5>
                </div>
                <div class="card-body">
                    @forelse($instructor->reviews->take(5) as $review)
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>{{ $review->student->name }}</strong>
                                    <div class="rating-stars small">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                            @if($review->comment)
                                <p class="text-muted mb-0 mt-2">{{ $review->comment }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted text-center">لا توجد تقييمات بعد</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

