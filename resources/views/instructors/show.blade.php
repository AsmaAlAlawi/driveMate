@extends('layouts.app')

@section('title', $instructor->full_name)

@push('styles')
<style>
/* ===== General Page Background ===== */
body {
    background-color: #f5efe6;
}



/* ===== Cards ===== */
.card {
    border: none;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
}

/* Page spacing under navbar */
.page-content {
    margin-top: 2.5rem;
}

/* ===== Instructor Profile ===== */
.card-body h3 {
    color: #6b1d24;
}

.card-body h4 {
    color: #6b1d24;
}

/* ===== Icons ===== */
.text-primary {
    color: #6b1d24 !important;
}

/* ===== Rating Stars ===== */
.rating-stars i {
    color: #d4af37;
}

.rating-stars small {
    font-size: 0.85rem;
}

/* ===== Card Headers ===== */
.card-header {
    border: none;
    padding: 1rem 1.2rem;
}

.card-header.bg-primary,
.card-header.bg-success,
.card-header.bg-warning {
    background: linear-gradient(135deg, #6b1d24, #8a2d36) !important;
    color: #f5efe6 !important;
}

.card-header h5 {
    font-weight: 700;
}

/* ===== Availability Table ===== */
.availability-table th {
    color: #6b1d24;
    font-weight: 600;
}

.availability-table td {
    padding: 12px;
    vertical-align: middle;
}

/* ===== Badges ===== */
.badge {
    border-radius: 30px;
    padding: 0.45rem 0.8rem;
    font-weight: 600;
}

.badge.bg-success {
    background-color: #6b1d24 !important;
    color: #f5efe6;
}

.badge.bg-danger {
    background-color: #8a2d36 !important;
}

.badge.bg-warning {
    background-color: #efe4d6 !important;
    color: #6b1d24;
}

/* ===== Buttons ===== */
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

.btn-secondary {
    border-radius: 30px;
}

/* ===== Booking Modal ===== */
.modal-content {
    border-radius: 20px;
    border: none;
}

.modal-header {
    background: linear-gradient(135deg, #6b1d24, #8a2d36);
    color: #f5efe6;
    border: none;
}

.modal-title {
    font-weight: 700;
}

.modal-body {
    background-color: #f5efe6;
}

.modal-footer {
    border: none;
}

/* ===== Form Controls ===== */
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

/* ===== Available Slots ===== */
.slot-btn {
    border-radius: 30px;
    border: 2px solid #6b1d24;
    color: #6b1d24;
}

.slot-btn.active,
.slot-btn:hover {
    background-color: #6b1d24;
    color: #f5efe6;
}

    
</style>
@endpush

@section('content')
<div class="row">
    <!-- معلومات المدرب -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                @if($instructor->photo)
                    <img src="{{ asset('storage/' . $instructor->photo) }}" 
                         class="img-fluid rounded-circle mb-3" 
                         style="width: 150px; height: 150px; object-fit: cover;"
                         alt="{{ $instructor->full_name }}">
                @else
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 150px; height: 150px;">
                        <i class="fas fa-user fa-4x"></i>
                    </div>
                @endif
                
                <h3 class="fw-bold">{{ $instructor->full_name }}</h3>
                
                <p class="text-muted">
                    <i class="fas fa-map-marker-alt"></i> {{ $instructor->region->name }}
                </p>
                
                <div class="rating-stars mb-3">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $instructor->average_rating)
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                    <div class="mt-2">
                        <span class="badge bg-warning text-dark">
                            {{ number_format($instructor->average_rating, 1) }}/5
                        </span>
                        <small class="text-muted">({{ $instructor->total_reviews }} تقييم)</small>
                    </div>
                </div>
                
                <hr>
                
                <div class="text-start">
                    <p>
                        <i class="fas fa-phone text-primary"></i>
                        <strong>الهاتف:</strong> {{ $instructor->phone }}
                    </p>
                    <p>
                        <i class="fas fa-id-card text-primary"></i>
                        <strong>رقم الرخصة:</strong> {{ $instructor->license_number }}
                    </p>
                    <p>
                        <i class="fas fa-award text-primary"></i>
                        <strong>سنوات الخبرة:</strong> {{ $instructor->years_experience }} سنة
                    </p>
                    <p>
                        <i class="fas fa-calendar-check text-primary"></i>
                        <strong>عدد الحجوزات:</strong> {{ $completedBookings }}
                    </p>
                </div>
                
                <hr>
                
                <h4 class="text-primary fw-bold">
                    {{ number_format($instructor->hourly_rate, 3) }} ر.ع / ساعة
                </h4>
                
                @auth
                    @if(Auth::user()->isStudent())
                        <button type="button" class="btn btn-primary btn-lg w-100 mt-3" 
                                data-bs-toggle="modal" data-bs-target="#bookingModal">
                            <i class="fas fa-calendar-plus"></i> احجز الآن
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 mt-3">
                        <i class="fas fa-sign-in-alt"></i> سجل دخول للحجز
                    </a>
                @endauth
            </div>
        </div>
    </div>
    
    <!-- التفاصيل والتقييمات -->
    <div class="col-md-8">
        <!-- نبذة عن المدرب -->
        @if($instructor->bio)
            <div class="card mb-4">
<div class="rounded-circle bg-light text-primary d-inline-flex align-items-center justify-content-center mb-3">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> نبذة عن المدرب</h5>
                </div>
                <div class="card-body">
                    <p>{{ $instructor->bio }}</p>
                </div>
            </div>
        @endif
        
        <!-- أوقات التوفر -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-clock"></i> أوقات التوفر</h5>
            </div>
            <div class="card-body">
                @if($instructor->availability->count() > 0)
                    <table class="table availability-table">
                        <thead>
                            <tr>
                                <th>اليوم</th>
                                <th>من الساعة</th>
                                <th>إلى الساعة</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instructor->availability as $slot)
                                <tr>
                                    <td>{{ $slot->day_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}</td>
                                    <td>
                                        @if($slot->is_available)
                                            <span class="badge bg-success">متاح</span>
                                        @else
                                            <span class="badge bg-danger">غير متاح</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">لم يتم تحديد أوقات التوفر بعد</p>
@endif
</div>
</div>
<!-- التقييمات -->
    <div class="card">
        <div class="card-header bg-warning">
            <h5 class="mb-0"><i class="fas fa-star"></i> التقييمات ({{ $instructor->total_reviews }})</h5>
        </div>
        <div class="card-body">
            @forelse($recentReviews as $review)
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center mb-2">
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
                        <small class="text-muted">
                            {{ $review->created_at->diffForHumans() }}
                        </small>
                    </div>
                    @if($review->comment)
                        <p class="text-muted mb-0">{{ $review->comment }}</p>
                    @endif
                </div>
            @empty
                <p class="text-muted text-center">لا توجد تقييمات بعد</p>
            @endforelse
        </div>
    </div>
</div>
</div>
<!-- Booking Modal -->
@auth
@if(Auth::user()->isStudent())
<div class="modal fade" id="bookingModal" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header bg-primary text-white">
<h5 class="modal-title"><i class="fas fa-calendar-plus"></i> حجز موعد مع {{ $instructor->full_name }}</h5>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
<form id="bookingForm">
<div class="mb-3">
<label class="form-label">اختر التاريخ *</label>
<input type="date" class="form-control" id="booking_date" 
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
</div>

<div class="mb-3">
                            <label class="form-label">الأوقات المتاحة *</label>
                            <div id="availableSlots">
                                <p class="text-muted">اختر التاريخ أولاً لعرض الأوقات المتاحة</p>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">عدد الساعات *</label>
                            <select class="form-select" id="duration_hours" required>
                                <option value="1">1 ساعة</option>
                                <option value="2">2 ساعة</option>
                                <option value="3">3 ساعات</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">ملاحظات إضافية</label>
                            <textarea class="form-control" id="student_notes" rows="3" 
                                      placeholder="أي معلومات تود إخبار المدرب بها..."></textarea>
                        </div>
                        
                        <div class="alert alert-info">
                            <strong>السعر الإجمالي:</strong> 
                            <span id="totalPrice">{{ number_format($instructor->hourly_rate, 3) }}</span> ر.ع
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" id="confirmBooking">
                        <i class="fas fa-check"></i> تأكيد الحجز
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
@endauth
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const instructorId = {{ $instructor->id }};
    const hourlyRate = {{ $instructor->hourly_rate }};
    const bookingDateInput = document.getElementById('booking_date');
    const availableSlotsDiv = document.getElementById('availableSlots');
    const durationSelect = document.getElementById('duration_hours');
    const totalPriceSpan = document.getElementById('totalPrice');
    
    let selectedSlot = null;
    
    // عند تغيير التاريخ
    if (bookingDateInput) {
        bookingDateInput.addEventListener('change', function() {
            const date = this.value;
            if (!date) return;
            
            // جلب الأوقات المتاحة
            fetch(`/instructors/${instructorId}/check-availability`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ date: date })
            })
            .then(response => response.json())
            .then(data => {
                if (data.available && data.slots.length > 0) {
                    let html = '<div class="row g-2">';
                    data.slots.forEach(slot => {
                        html += `
                            <div class="col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 slot-btn" 
                                        data-start="${slot.start}" data-end="${slot.end}">
                                    ${slot.display}
                                </button>
                            </div>
                        `;
                    });
                    html += '</div>';
                    availableSlotsDiv.innerHTML = html;
                    
                    // إضافة حدث النقر على الأزرار
                    document.querySelectorAll('.slot-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('active'));
                            this.classList.add('active');
                            selectedSlot = {
                                start: this.dataset.start,
                                end: this.dataset.end
                            };
                        });
                    });
                } else {
                    availableSlotsDiv.innerHTML = '<p class="text-danger">لا توجد أوقات متاحة في هذا اليوم</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                availableSlotsDiv.innerHTML = '<p class="text-danger">حدث خطأ في جلب الأوقات</p>';
            });
        });
    }
    
    // تحديث السعر عند تغيير عدد الساعات
    if (durationSelect) {
        durationSelect.addEventListener('change', function() {
            const hours = parseInt(this.value);
            const total = hourlyRate * hours;
            totalPriceSpan.textContent = total.toFixed(3);
        });
    }
    
    // تأكيد الحجز
    const confirmBtn = document.getElementById('confirmBooking');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            const date = bookingDateInput.value;
            const duration = durationSelect.value;
            const notes = document.getElementById('student_notes').value;
            
            if (!date) {
                alert('يرجى اختيار التاريخ');
                return;
            }
            
            if (!selectedSlot) {
                alert('يرجى اختيار الوقت');
                return;
            }
            
            // إرسال نموذج الحجز
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("bookings.store") }}';
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            const inputs = {
                instructor_id: instructorId,
                booking_date: date,
                start_time: selectedSlot.start,
                end_time: selectedSlot.end,
                duration_hours: duration,
                student_notes: notes
            };
            
            for (let key in inputs) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = inputs[key];
                form.appendChild(input);
            }
            
            document.body.appendChild(form);
            form.submit();
        });
    }
});
</script>
@endpush