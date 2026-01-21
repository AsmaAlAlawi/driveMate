@extends('layouts.app')

@section('title', 'جميع المدربين')

@push('styles')
<style>
/* ===== Instructors Page ===== */

/* Page spacing under navbar */
.page-content {
    margin-top: 2.5rem;
}

/* Page title */
.page-title h1,
h1 {
    color: #6b1d24;
    font-weight: 700;
}

/* Primary button */
.btn-primary {
    background-color: #6b1d24;
    border-color: #6b1d24;
    font-weight: 600;
}

.btn-primary:hover {
    background-color: #5a1820;
    border-color: #5a1820;
}

/* Instructor Card */
.instructor-card {
    border: none;
    border-radius: 18px;
    background-color: #ffffff;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.instructor-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 35px rgba(0, 0, 0, 0.1);
}

/* Card title */
.instructor-card h5 {
    color: #3a2a2a;
    font-weight: 700;
}

/* Region */
.instructor-card small {
    color: #8a6d6d;
}

/* Rating Stars */
.rating-stars i {
    color: #d4af37;
}

.rating-stars span {
    font-size: 0.85rem;
    margin-inline-start: 5px;
}

/* Bio */
.instructor-card p {
    line-height: 1.6;
}

/* Badges */
.badge {
    border-radius: 30px;
    padding: 0.45rem 0.8rem;
    font-weight: 600;
    font-size: 0.8rem;
}

.badge.bg-info {
    background-color: #efe4d6 !important;
    color: #6b1d24;
}

.badge.bg-success {
    background-color: #6b1d24 !important;
    color: #f5efe6;
}

/* Price */
.instructor-card .text-primary {
    color: #6b1d24 !important;
}

/* Details Button */
.instructor-card .btn-primary {
    border-radius: 30px;
    padding: 0.4rem 1.3rem;
    font-size: 0.9rem;
}

/* Empty State */
.alert-info {
    background-color: #f5efe6;
    color: #6b1d24;
    border: none;
}

/* Pagination */
.pagination .page-link {
    color: #6b1d24;
    border-radius: 50%;
    margin: 0 3px;
}

.pagination .page-item.active .page-link {
    background-color: #6b1d24;
    border-color: #6b1d24;
    color: #f5efe6;
}

/* Avatar Placeholder (No Image) */
.avatar-placeholder {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background-color: #6b1d24; /* عنابي */
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar-placeholder i {
    color: #f5efe6; /* بيج */
}
</style>
@endpush

@section('content')
<div class="page-content">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">
            <i class="fas fa-users me-2"></i> جميع المدربين
        </h1>
        <a href="{{ route('instructors.search') }}" class="btn btn-primary">
            <i class="fas fa-filter"></i> بحث متقدم
        </a>
    </div>

    <!-- Instructors List -->
    <div class="row">
        @forelse($instructors as $instructor)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card instructor-card h-100">
                    <div class="card-body">

                        <!-- Avatar + Name -->
                        <div class="d-flex align-items-center mb-3">
                            @if($instructor->photo)
                                <img src="{{ asset('storage/' . $instructor->photo) }}"
                                     class="rounded-circle me-3"
                                     style="width: 70px; height: 70px; object-fit: cover;"
                                     alt="{{ $instructor->full_name }}">
                            @else
                                <div class="avatar-placeholder me-3">
                                    <i class="fas fa-user fa-2x"></i>
                                </div>
                            @endif

                            <div>
                                <h5 class="mb-1">{{ $instructor->full_name }}</h5>
                                <small>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $instructor->region->name }}
                                </small>
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="rating-stars mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $instructor->average_rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                            <span class="text-muted">
                                ({{ $instructor->total_reviews }} تقييم)
                            </span>
                        </div>

                        <!-- Bio -->
                        @if($instructor->bio)
                            <p class="text-muted small">
                                {{ Str::limit($instructor->bio, 100) }}
                            </p>
                        @endif

                        <!-- Stats -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-info">
                                <i class="fas fa-calendar-check"></i>
                                {{ $instructor->total_bookings }} حجز
                            </span>
                            <span class="badge bg-success">
                                <i class="fas fa-award"></i>
                                {{ $instructor->years_experience }} سنوات خبرة
                            </span>
                        </div>

                        <!-- Price + Button -->
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold fs-5">
                                {{ number_format($instructor->hourly_rate, 3) }} ر.ع
                            </span>
                            <a href="{{ route('instructors.show', $instructor) }}" class="btn btn-primary">
                                عرض التفاصيل
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i>
                    لا توجد مدربين متاحين حالياً
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $instructors->links() }}
    </div>

</div>
@endsection
