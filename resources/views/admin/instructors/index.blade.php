@extends('layouts.app')

@section('title', 'إدارة المدربين')

@push('styles')
<style>
    /* خلفية بيج هادئة */
    body {
        background: #F5F1EB;
    }

    /* كارد أنيق + زجاجي */
    .admin-card {
        background: rgba(255,255,255,0.82);
        backdrop-filter: blur(10px);
        border: 1px solid #e6dfd6;
    }

    /* العنوان */
    h1 {
        color: #6D1B2D;
    }

    /* أزرار الفلاتر */
    .btn-group .btn {
        border-color: rgba(109,27,45,0.25);
    }

    .btn-group .btn.active,
    .btn-group .btn:hover {
        background-color: rgba(109,27,45,0.08);
        border-color: rgba(109,27,45,0.4);
        color: #6D1B2D;
    }

    /* Inputs focus */
    .form-control:focus,
    .form-select:focus {
        border-color: #6D1B2D;
        box-shadow: 0 0 0 0.25rem rgba(109,27,45,0.15);
    }

    /* ألوان Bootstrap الرئيسية */
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
        <h1 class="text-[#6D1B2D]"><i class="fas fa-user-tie"></i> إدارة المدربين</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right"></i> العودة للوحة التحكم
        </a>
    </div>

    <!-- فلاتر -->
    <div class="card mb-4 admin-card">
        <div class="card-body">
            <div class="btn-group" role="group">
                <a href="{{ route('admin.instructors.index') }}"
                   class="btn btn-outline-primary {{ !request('status') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> الكل ({{ $instructors->total() }})
                </a>
                <a href="{{ route('admin.instructors.index', ['status' => 'active']) }}"
                   class="btn btn-outline-success {{ request('status') == 'active' ? 'active' : '' }}">
                    <i class="fas fa-check-circle"></i> النشطين
                </a>
                <a href="{{ route('admin.instructors.index', ['status' => 'pending']) }}"
                   class="btn btn-outline-warning {{ request('status') == 'pending' ? 'active' : '' }}">
                    <i class="fas fa-clock"></i> في الانتظار
                </a>
                <a href="{{ route('admin.instructors.index', ['status' => 'inactive']) }}"
                   class="btn btn-outline-danger {{ request('status') == 'inactive' ? 'active' : '' }}">
                    <i class="fas fa-ban"></i> غير نشطين
                </a>
            </div>
        </div>
    </div>

    <!-- قائمة المدربين -->
    <div class="card admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>الصورة</th>
                            <th>الاسم</th>
                            <th>المنطقة</th>
                            <th>الهاتف</th>
                            <th>السعر/ساعة</th>
                            <th>التقييم</th>
                            <th>الحجوزات</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($instructors as $instructor)
                            <tr>
                                <td>{{ $instructor->id }}</td>
                                <td>
                                    @if($instructor->photo)
                                        <img src="{{ asset('storage/' . $instructor->photo) }}"
                                             class="rounded-circle"
                                             style="width: 50px; height: 50px; object-fit: cover;"
                                             alt="{{ $instructor->full_name }}">
                                    @else
                                        <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center"
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $instructor->full_name }}</strong><br>
                                    <small class="text-muted">{{ $instructor->user->email }}</small>
                                </td>
                                <td>{{ $instructor->region->name }}</td>
                                <td>{{ $instructor->phone }}</td>
                                <td class="fw-bold text-success">{{ number_format($instructor->hourly_rate, 3) }} ر.ع</td>
                                <td>
                                    <div class="rating-stars small">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $instructor->average_rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <small class="text-muted">({{ $instructor->reviews_count }})</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $instructor->bookings_count }}</span>
                                </td>
                                <td>
                                    @if($instructor->status == 'active')
                                        <span class="badge bg-success">نشط</span>
                                    @elseif($instructor->status == 'pending')
                                        <span class="badge bg-warning">في الانتظار</span>
                                    @else
                                        <span class="badge bg-danger">غير نشط</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.instructors.show', $instructor) }}"
                                           class="btn btn-sm btn-info" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if($instructor->status == 'pending')
                                            <form action="{{ route('admin.instructors.approve', $instructor) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="موافقة">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if($instructor->status == 'active')
                                            <form action="{{ route('admin.instructors.reject', $instructor) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning" title="إيقاف">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.instructors.destroy', $instructor) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="حذف"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا المدرب؟')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">لا يوجد مدربين</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $instructors->appends(request()->query())->links() }}
    </div>
</div>
@endsection

