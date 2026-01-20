@extends('layouts.app')

@section('title', 'استكمال بيانات المدرب')


@push('styles')
<style>
    /* خلفية بيج هادئة */
    body {
        background: #F5F1EB;
    }

    /* كارد أنيق + زجاجي */
    .instructor-card {
        background: rgba(255,255,255,0.82);
        backdrop-filter: blur(10px);
        border: 1px solid #e6dfd6;
    }

    /* هيدر الكارد */
    .instructor-card-header {
        background: transparent;
        border-bottom: 0;
        color: #6D1B2D;
    }

    /* العنوان */
    .instructor-card-header h4 {
        color: #6D1B2D;
        font-weight: 700;
    }

    /* تنسيق التنبيهات */
    .instructor-alert {
        background: rgba(109,27,45,0.08);
        border-color: rgba(109,27,45,0.25);
        color: #6D1B2D;
    }

    /* Inputs focus */
    .form-control:focus,
    .form-select:focus {
        border-color: #6D1B2D;
        box-shadow: 0 0 0 0.25rem rgba(109,27,45,0.15);
    }

    /* أزرار عنابية */
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

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card instructor-card">
                <div class="card-header instructor-card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-user-tie"></i> استكمال بيانات المدرب
                    </h4>
                </div>

                <div class="card-body">
                    <div class="alert instructor-alert">
                        <i class="fas fa-info-circle"></i>
                        يرجى إكمال بياناتك كمدرب. سيتم مراجعة طلبك من قبل الإدارة قبل تفعيل حسابك.
                    </div>

                    <form action="{{ route('instructor.store-profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">الاسم الكامل *</label>
                                <input type="text" name="full_name"
                                       class="form-control @error('full_name') is-invalid @enderror"
                                       value="{{ old('full_name') }}" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">رقم الهاتف *</label>
                                <input type="text" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}" placeholder="مثال: 12345678" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">المنطقة *</label>
                                <select name="region_id"
                                        class="form-select @error('region_id') is-invalid @enderror"
                                        required>
                                    <option value="">اختر المنطقة</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}"
                                            {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                            {{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('region_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">رقم الرخصة *</label>
                                <input type="text" name="license_number"
                                       class="form-control @error('license_number') is-invalid @enderror"
                                       value="{{ old('license_number') }}" required>
                                @error('license_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">سنوات الخبرة *</label>
                                <input type="number" name="years_experience"
                                       class="form-control @error('years_experience') is-invalid @enderror"
                                       value="{{ old('years_experience', 0) }}" min="0" required>
                                @error('years_experience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">السعر للساعة (ر.ع) *</label>
                                <input type="number" name="hourly_rate"
                                       class="form-control @error('hourly_rate') is-invalid @enderror"
                                       value="{{ old('hourly_rate') }}" step="0.001" min="0" required>
                                @error('hourly_rate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">نبذة عنك</label>
                            <textarea name="bio"
                                      class="form-control @error('bio') is-invalid @enderror"
                                      rows="4"
                                      placeholder="اكتب نبذة عن خبراتك ومهاراتك...">{{ old('bio') }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">الصورة الشخصية</label>
                            <input type="file" name="photo"
                                   class="form-control @error('photo') is-invalid @enderror"
                                   accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">يفضل صورة واضحة بحجم لا يتجاوز 2 ميجابايت</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> إرسال الطلب
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-secondary">إلغاء</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
