@extends('layouts.app')

@section('title', 'تقييم المدرب')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning">
                <h4 class="mb-0">
                    <i class="fas fa-star"></i> تقييم المدرب
                </h4>
            </div>
            <div class="card-body">
                <!-- معلومات الحجز -->
                <div class="alert alert-info">
                    <h5>{{ $booking->instructor->full_name }}</h5>
                    <p class="mb-1">
                        <i class="fas fa-calendar"></i> {{ $booking->booking_date->format('Y-m-d') }}
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-clock"></i>
                        {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} -
                        {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                    </p>
                </div>
                
                <form action="{{ route('reviews.store', $booking) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">التقييم *</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required>
                            <label for="star5" title="5 نجوم"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" title="4 نجوم"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" title="3 نجوم"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" title="نجمتان"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" title="نجمة واحدة"><i class="fas fa-star"></i></label>
                        </div>
                        @error('rating')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        </div>
                
                <div class="mb-4">
                    <label for="comment" class="form-label fw-bold">التعليق (اختياري)</label>
                    <textarea class="form-control @error('comment') is-invalid @enderror" 
                              id="comment" 
                              name="comment" 
                              rows="4"
                              placeholder="شاركنا تجربتك مع المدرب...">{{ old('comment') }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">سيظهر تعليقك في صفحة المدرب لمساعدة المتدربين الآخرين</small>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-paper-plane"></i> إرسال التقييم
                    </button>
                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-secondary">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@push('styles')
<style>
    .star-rating {
        direction: ltr;
        display: inline-flex;
        flex-direction: row-reverse;
        font-size: 2.5rem;
    }
    
    .star-rating input {
        display: none;
    }
    
    .star-rating label {
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s;
    }
    
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
</style>
@endpush
