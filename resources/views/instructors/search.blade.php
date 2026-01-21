@extends('layouts.app')

@section('title', 'البحث عن مدرب')


@push('styles')
<style>

/* ===== Search Page ===== */

/* Page spacing under navbar */
.page-content {
    margin-top: 2.5rem;
}

/* Page title */
h1 {
    color: #6b1d24;
    font-weight: 700;
}

/* Search Card */
.card {
    border: none;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
}

/* Form labels */
.form-label {
    color: #3a2a2a;
    font-weight: 600;
}

/* Inputs & Selects */
.form-control,
.form-select {
    border-radius: 12px;
    border: 2px solid #e8ddcf;
}

.form-control:focus,
.form-select:focus {
    border-color: #8a2d36;
    box-shadow: 0 0 0 0.15rem rgba(138, 45, 54, 0.25);
}

/* Search Button */
.btn-primary {
    background-color: #6b1d24;
    border-color: #6b1d24;
    border-radius: 30px;
    font-weight: 600;
}

.btn-primary:hover {
    background-color: #5a1820;
    border-color: #5a1820;
}

/* ===== Star Rating Filter ===== */
.star-rating {
    display: flex;
    gap: 4px;
    font-size: 1.4rem;
    cursor: pointer;
}

.star-rating span {
    color: #e0d4c4;
    transition: color 0.3s ease;
}

.star-rating span.active,
.star-rating span:hover,
.star-rating span:hover ~ span {
    color: #d4af37;
}

/* ===== Instructor Cards ===== */
.instructor-card {
    border-radius: 18px;
    background-color: #ffffff;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.instructor-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 35px rgba(0, 0, 0, 0.1);
}

/* Card Title */
.instructor-card h5 {
    color: #3a2a2a;
    font-weight: 700;
}

/* Rating stars */
.rating-stars i {
    color: #d4af37;
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
.text-primary {
    color: #6b1d24 !important;
}

/* Empty Alert */
.alert-warning {
    background-color: #f5efe6;
    border: none;
    color: #6b1d24;
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

</style>
@endpush


@section('content')
<h1 class="mb-4"><i class="fas fa-search"></i> البحث عن مدرب</h1>

<!-- نموذج البحث -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('instructors.search') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">المنطقة</label>
                    <select name="region_id" class="form-select">
                        <option value="">جميع المناطق</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" 
                                    {{ request('region_id') == $region->id ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">السعر من</label>
                    <input type="number" name="min_price" class="form-control" 
                           placeholder="0.000" step="0.001" value="{{ request('min_price') }}">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">السعر إلى</label>
                    <input type="number" name="max_price" class="form-control" 
                           placeholder="100.000" step="0.001" value="{{ request('max_price') }}">
                </div>
                
               <div class="col-md-2">
    <label class="form-label">التقييم الأدنى</label>

    <div class="star-rating" dir="ltr">
        <span data-value="5">★</span>
        <span data-value="4">★</span>
        <span data-value="3">★</span>
        <span data-value="2">★</span>
        <span data-value="1">★</span>
    </div>

    <input type="hidden" name="min_rating" id="min_rating" value="{{ request('min_rating') }}">
</div>

                
                <div class="col-md-2">
                    <label class="form-label">الترتيب</label>
                    <select name="sort_by" class="form-select">
                        <option value="average_rating" {{ request('sort_by') == 'average_rating' ? 'selected' : '' }}>
                            الأعلى تقييماً
                        </option>
                        <option value="hourly_rate" {{ request('sort_by') == 'hourly_rate' ? 'selected' : '' }}>
                            السعر
                        </option>
                        <option value="total_bookings" {{ request('sort_by') == 'total_bookings' ? 'selected' : '' }}>
                            الأكثر حجزاً
                        </option>
                    </select>
                </div>
                
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- النتائج -->
<div class="mb-3">
    <p class="text-muted">
        تم العثور على <strong>{{ $instructors->total() }}</strong> مدرب
    </p>
</div>

<div class="row">
    @forelse($instructors as $instructor)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card instructor-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($instructor->photo)
                            <img src="{{ asset('storage/' . $instructor->photo) }}" 
                                 class="rounded-circle me-3" 
                                 style="width: 70px; height: 70px; object-fit: cover;"
                                 alt="{{ $instructor->full_name }}">
                        @else
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" 
                                 style="width: 70px; height: 70px;">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                        @endif
                        
                        <div>
                            <h5 class="mb-1">{{ $instructor->full_name }}</h5>
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt"></i> {{ $instructor->region->name }}
                            </small>
                        </div>
                    </div>
                    
                    <div class="rating-stars mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $instructor->average_rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                        <span class="text-muted">({{ $instructor->total_reviews }})</span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-info">
                            {{ $instructor->total_bookings }} حجز
                        </span>
                        <span class="badge bg-success">
                            {{ $instructor->years_experience }} سنة خبرة
                        </span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-primary fw-bold fs-5">
                            {{ number_format($instructor->hourly_rate, 3) }} ر.ع
                        </span>
                        <a href="{{ route('instructors.show', $instructor) }}" class="btn btn-primary">
                            التفاصيل
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-triangle"></i> 
                لم يتم العثور على مدربين بالمواصفات المطلوبة. جرب تعديل معايير البحث.
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center">
    {{ $instructors->appends(request()->query())->links() }}
</div>


<script>
document.querySelectorAll('.star-rating span').forEach(star => {
    star.addEventListener('click', function () {
        const value = this.dataset.value;
        document.getElementById('min_rating').value = value;

        document.querySelectorAll('.star-rating span').forEach(s => {
            s.classList.toggle('active', s.dataset.value <= value);
        });
    });
});
</script>

@endsection