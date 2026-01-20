@extends('layouts.app')

@section('title', 'الصفحة الرئيسية - نظام حجز مدرب تعليم السياقة')


@push('styles')
<style>
    /* Hero Section */
/* ===== Hero Section ===== */
.hero-section {
    background: linear-gradient(
        135deg,
        rgba(90, 24, 32, 0.95),
        rgba(107, 29, 36, 0.95)
    ),
    url('/images/hero-bg.jpg'); /* اختياري */
    background-size: cover;
    background-position: center;
    padding: 6rem 0;
    color: #f5efe6;
    position: relative;
    overflow: hidden;
}

/* Title */
.hero-section h1 {
    color: #f5efe6;
    line-height: 1.3;
    letter-spacing: 0.5px;
}

/* Paragraph */
.hero-section p {
    color: rgba(245, 239, 230, 0.85);
    max-width: 520px;
}

/* Buttons */
.hero-section .btn {
    border-radius: 30px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    letter-spacing: 0.4px;
    margin-inline-end: 10px;
    transition: all 0.3s ease;
}

/* Outline Button */
.hero-section .btn-outline-light {
    border: 2px solid rgba(245, 239, 230, 0.7);
    color: #f5efe6;
}

.hero-section .btn-outline-light:hover {
    background-color: #f5efe6;
    color: #6b1d24;
    border-color: #f5efe6;
    transform: translateY(-2px);
}

/* Responsive spacing */
@media (max-width: 768px) {
    .hero-section {
        padding: 4rem 0;
        text-align: center;
    }

    .hero-section p {
        margin-inline: auto;
    }
}



                                                  /* Stats Section */

/* القسم */
.stats-section {
    font-family: 'Cairo', 'Tajawal', sans-serif;
}

/* الكرت */
.stat-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 35px 20px;
    text-align: center;
    height: 100%;
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 35px rgba(77, 15, 24, 0.18);
}

/* الأيقونة */
.stat-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 20px;
    border-radius: 50%;
    background-color: #4d0f18;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-icon i {
    color: #ffffff;
    font-size: 1.8rem;
}

/* الرقم */
.stat-card h2 {
    font-weight: 900;
    color: #4d0f18;
    margin-bottom: 8px;
}

/* النص */
.stat-card p {
    color: #6c757d;
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0;
}



                                  /* Top Instructors Section */


/* العنوان */
.instructors-section h2 {
    color: #4d0f18;
    font-weight: 800;
}

.instructors-section h2 i {
    color: #4d0f18;
}

/* الكرت */
.instructor-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.instructor-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(77, 15, 24, 0.18);
}

/* الغلاف */
.instructor-cover {
    height: 100px;
    background-color: #4d0f18;
}

/* الصورة */
.instructor-img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    margin: -55px auto 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #4d0f18;
    color: #fff;
    font-size: 2.5rem;
    border: 4px solid #ffffff;
}

/* المحتوى */
.instructor-body {
    padding: 25px;
}

.instructor-body h4 {
    font-weight: 700;
    color: #4d0f18;
    margin-bottom: 8px;
}

/* المنطقة */
.instructor-region {
    color: #6c757d;
    font-size: 0.9rem;
}

/* التقييم */
.rating-stars {
    margin: 12px 0;
    color: #4d0f18;
    font-size: 0.9rem;
}

.rating-stars span {
    color: #6c757d;
    margin-right: 6px;
}

/* الشارات */
.instructor-badges {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 15px;
}

.instructor-badges span {
    background: #f4e6e8;
    color: #4d0f18;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

/* الفوتر */
.instructor-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price {
    font-weight: 800;
    color: #4d0f18;
    font-size: 1.2rem;
}

.price small {
    display: block;
    font-size: 0.75rem;
    color: #6c757d;
}

/* الأزرار */
.instructor-btn,
.instructor-btn-lg {
    background: #4d0f18;
    color: #ffffff;
    border-radius: 25px;
    padding: 8px 20px;
    font-weight: 700;
    transition: 0.3s;
}

.instructor-btn:hover,
.instructor-btn-lg:hover {
    background: #7a2a33;
    color: #ffffff;
}

.instructor-btn-lg {
    padding: 12px 35px;
}

.instructor-btn:focus,
.instructor-btn:active,
.instructor-btn:focus-visible {
    outline: none !important;
    box-shadow: none !important;
}




                                        /* How It Works Section */


/* الخلفية */
.how-it-works {
    background-color: #faf7f8;
}

/* الكرت */
.how-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 35px 25px;
    text-align: center;
    height: 100%;
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.how-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 35px rgba(77, 15, 24, 0.18);
}

/* الرقم */
.step-number {
    font-size: 3.5rem;
    font-weight: 900;
    color: #4d0f18;
    margin-bottom: 15px;
}

/* الأيقونة */
.step-icon {
    font-size: 2.5rem;
    color: #7a2a33;
    margin-bottom: 20px;
}

/* العنوان */
.how-card h4 {
    font-weight: 700;
    color: #4d0f18;
    margin-bottom: 15px;
}

/* النص */
.how-card p {
    color: #6c757d;
    font-size: 0.95rem;
    line-height: 1.7;
}


                            /*Regions Section */


/* عنوان السكشن */
.regions-section h2 {
    color: #4d0f18;
    font-weight: 800;
}

.regions-section h2 i {
    color: #4d0f18;
}

/* الكرت */
.region-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 35px 20px;
    text-align: center;
    height: 100%;
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.region-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 35px rgba(77, 15, 24, 0.18);
}

/* الأيقونة */
.region-icon {
    font-size: 2.8rem;
    color: #7a2a33;
    margin-bottom: 20px;
}

/* اسم المنطقة */
.region-card h5 {
    font-weight: 700;
    color: #4d0f18;
    margin-bottom: 15px;
    font-size: 1.05rem;
}

/* عدد المدربين */
.region-badge {
    display: inline-block;
    background-color: #f4e6e8;
    color: #4d0f18;
    font-weight: 600;
    border-radius: 20px;
    padding: 6px 14px;
    font-size: 0.85rem;
}


                                    /* Features Section */

/* خلفية السكشن */
.why-us-section {
    background-color: #faf7f8;
}

/* عنوان السكشن */
.why-us-section h2 {
    color: #4d0f18;
    font-weight: 800;
}

/* الكرت */
.why-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 40px 25px;
    text-align: center;
    height: 100%;
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.why-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 35px rgba(77, 15, 24, 0.18);
}

/* الأيقونة */
.why-icon {
    font-size: 3.2rem;
    color: #4d0f18;
    margin-bottom: 25px;
}

/* العنوان */
.why-card h4 {
    font-weight: 700;
    color: #4d0f18;
    margin-bottom: 15px;
}

/* النص */
.why-card p {
    color: #6c757d;
    font-size: 0.95rem;
    line-height: 1.7;
}


                                    /*CTA Section*/
/* كرت الدعوة */
.cta-card {
    background-color: #4d0f18;
    border-radius: 32px;
    padding: 10px;
    box-shadow: 0 20px 50px rgba(181, 156, 160, 0.35);
}

/* المحتوى */
.cta-content {
    background-color: #4d0f18;
    border-radius: 28px;
    padding: 70px 30px;
    color: #ffffff;
}

/* العنوان */
.cta-content h2 {
    font-weight: 900;
    letter-spacing: 0.5px;
}

/* النص */
.cta-content p {
    color: #f2d9dc;
    font-size: 1.1rem;
}

/* الزر */
.cta-btn {
    background-color: #ffffff;
    color: #4d0f18;
    border-radius: 30px;
    padding: 15px 55px;
    font-weight: 800;
    font-size: 1.05rem;
    box-shadow: 0 12px 30px rgba(255, 248, 248, 0.25);
    transition: all 0.3s ease;
}

.cta-btn:hover {
    background-color: #f4e6e8;
    color: #4d0f18;
    transform: translateY(-3px);
}



</style>
@endpush



@section('content')

<!-- Hero Section -->
<section class="hero-section animate__animated animate__fadeIn">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInUp">
                    ابدأ رحلتك في تعلم القيادة الآن! 🚗
                </h1>
                <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                    احجز مع أفضل المدربين المحترفين في سلطنة عمان. تجربة تعليمية متميزة وأسعار مناسبة للجميع
                </p>
                <div class="animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="{{ route('instructors.search') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-search me-2"></i> ابحث عن مدرب</a>
                    <a href="{{ route('instructors.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-users me-2"></i> جميع المدربين</a>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight animate__delay-1s">
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="container my-5">
     <div class="row g-4 animate__animated animate__fadeInUp"> 
        <div class="col-lg-3 col-md-6"> <div class="stat-card">
        <div class="stat-icon" style="background: #4d0f18;">
         <i class="fas fa-user-tie"></i> 
        </div> <h2 class="fw-bold mb-2" style="color: #7a1f2b;" >{{ $totalInstructors }}+</h2>
         <p class="text-muted mb-0 fw-600" style= "font-family: " 'Cairo' sans-serif;>مدرب محترف</p> 
        </div> </div>
         <div class="col-lg-3 col-md-6"> 
            <div class="stat-card">
                 <div class="stat-icon" style="background: #4d0f18;"> 
                    <i class="fas fa-map-marker-alt"></i> </div>
                     <h2 class="fw-bold mb-2" style="color: #7a1f2b;">{{ $regions->count() }}</h2> 
                     <p class="text-muted mb-0 fw-600">منطقة متاحة</p> 
                    </div> </div> <div class="col-lg-3 col-md-6"> 
                        <div class="stat-card"> 
                            <div class="stat-icon" style="background: #4d0f18;">
                                 <i class="fas fa-calendar-check"></i> 
                                </div> 
            <h2 class="fw-bold mb-2" style="color: #7a1f2b;">500+</h2>
             <p class="text-muted mb-0 fw-600">حجز ناجح</p> 
            </div>
            </div>
            <div class="col-lg-3 col-md-6">
            <div class="stat-card"> 
            <div class="stat-icon" style="background: #4d0f18 ;">
                        <i class="fas fa-star"></i>
                </div> 
                        <h2 class="fw-bold mb-2" style="color: #7a1f2b;">4.9/5</h2>
                        <p class="text-muted mb-0 fw-600">تقييم العملاء</p> 
                </div> 
            </div>
        </div>
     </section>

<!-- Top Instructors Section -->
<section class="container my-5 instructors-section">
    <div class="text-center mb-5 animate__animated animate__fadeIn">
        <h2 class="display-5 fw-bold mb-3">
            <i class="fas fa-trophy me-2"></i>
            أفضل المدربين المحترفين
        </h2>
        <p class="lead text-muted">
            مدربون معتمدون بخبرات طويلة وتقييمات ممتازة
        </p>
    </div>

    <div class="row g-4">
        @forelse($topInstructors as $index => $instructor)
            <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp"
                 style="animation-delay: {{ $index * 0.1 }}s;">
                <div class="instructor-card">
                    
                    <div class="instructor-cover"></div>

                    @if($instructor->photo)
                        <img src="{{ asset('storage/' . $instructor->photo) }}"
                             class="instructor-img"
                             alt="{{ $instructor->full_name }}">
                    @else
                        <div class="instructor-img instructor-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif

                    <div class="instructor-body text-center">
                        <h4>{{ $instructor->full_name }}</h4>

                        <p class="instructor-region">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $instructor->region->name }}
                        </p>

                        <div class="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= $instructor->average_rating ? 'fas' : 'far' }} fa-star"></i>
                            @endfor
                            <span>({{ $instructor->total_reviews }} تقييم)</span>
                        </div>

                        <div class="instructor-badges">
                            <span>
                                <i class="fas fa-calendar-check"></i>
                                {{ $instructor->total_bookings }} حجز
                            </span>
                            <span>
                                <i class="fas fa-award"></i>
                                {{ $instructor->years_experience }} سنة خبرة
                            </span>
                        </div>

                        <div class="instructor-footer">
                            <div class="price">
                                {{ number_format($instructor->hourly_rate, 3) }}
                                <small>ر.ع / ساعة</small>
                            </div>
                            <a href="{{ route('instructors.show', $instructor) }}"
                               class="btn instructor-btn">
                                التفاصيل
                                <i class="fas fa-arrow-left ms-2"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light text-center shadow-sm">
                    <i class="fas fa-info-circle fa-2x mb-3 text-muted"></i>
                    <h5>لا توجد مدربين متاحين حالياً</h5>
                </div>
            </div>
        @endforelse
    </div>

    @if($topInstructors->count() > 0)
        <div class="text-center mt-5 animate__animated animate__fadeIn">
            <a href="{{ route('instructors.index') }}" class="btn instructor-btn-lg">
                عرض جميع المدربين
                <i class="fas fa-arrow-left ms-2"></i>
            </a>
        </div>
    @endif
</section>


<!-- How It Works Section -->
<section class="py-5 how-it-works">
    <div class="container">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h2 class="display-5 fw-bold mb-3">
                <i class="fas fa-lightbulb me-2 text-warning"></i>
                كيف يعمل النظام؟
            </h2>
            <p class="lead text-muted">احجز مدربك في 4 خطوات بسيطة</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="how-card animate__animated animate__zoomIn">
                    <div class="step-number">1</div>
                    <i class="fas fa-search step-icon"></i>
                    <h4>ابحث عن مدرب</h4>
                    <p>اختر المدرب المناسب حسب المنطقة، السعر، والتقييمات</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="how-card animate__animated animate__zoomIn" style="animation-delay:0.1s;">
                    <div class="step-number">2</div>
                    <i class="fas fa-calendar-alt step-icon"></i>
                    <h4>احجز موعدك</h4>
                    <p>اختر التاريخ والوقت المناسب من الأوقات المتاحة</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="how-card animate__animated animate__zoomIn" style="animation-delay:0.2s;">
                    <div class="step-number">3</div>
                    <i class="fas fa-credit-card step-icon"></i>
                    <h4>ادفع بأمان</h4>
                    <p>الدفع الإلكتروني الآمن عبر بوابة ثواني</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="how-card animate__animated animate__zoomIn" style="animation-delay:0.3s;">
                    <div class="step-number">4</div>
                    <i class="fas fa-graduation-cap step-icon"></i>
                    <h4>ابدأ التدريب</h4>
                    <p>استمتع بتجربة تعليمية احترافية ومتميزة</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Regions Section -->
<section class="container my-5 regions-section">
    <div class="text-center mb-5 animate__animated animate__fadeIn">
        <h2 class="display-5 fw-bold mb-3">
            <i class="fas fa-map-marked-alt me-2"></i>
            المناطق المتاحة
        </h2>
        <p class="lead text-muted">نغطي جميع محافظات السلطنة</p>
    </div>

    <div class="row g-4">
        @foreach($regions as $index => $region)
            <div class="col-lg-3 col-md-4 col-sm-6 animate__animated animate__fadeInUp"
                 style="animation-delay: {{ $index * 0.05 }}s;">
                <a href="{{ route('instructors.search', ['region_id' => $region->id]) }}"
                   class="text-decoration-none">
                    <div class="region-card">
                        <i class="fas fa-map-marker-alt region-icon"></i>
                        <h5>{{ $region->name }}</h5>
                        <span class="region-badge">
                            {{ $region->instructors_count }} مدرب
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>


<!-- Features Section -->
<section class="py-5 why-us-section">
    <div class="container">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h2 class="display-5 fw-bold mb-3">
                لماذا تختارنا؟
            </h2>
            <p class="lead text-muted">نقدم لك أفضل تجربة في تعلم القيادة</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <i class="fas fa-shield-alt why-icon"></i>
                    <h4>دفع آمن ومضمون</h4>
                    <p>جميع المعاملات محمية ببوابة ثواني الإلكترونية الآمنة</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <i class="fas fa-medal why-icon"></i>
                    <h4>مدربون معتمدون</h4>
                    <p>جميع المدربين حاصلون على شهادات معتمدة وخبرة طويلة</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <i class="fas fa-clock why-icon"></i>
                    <h4>مرونة في المواعيد</h4>
                    <p>اختر الوقت الذي يناسبك من الأوقات المتاحة</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <i class="fas fa-star why-icon"></i>
                    <h4>تقييمات حقيقية</h4>
                    <p>اطلع على تجارب المتدربين السابقين واختر بثقة</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <i class="fas fa-headset why-icon"></i>
                    <h4>دعم فني متواصل</h4>
                    <p>فريق الدعم جاهز لمساعدتك في أي وقت</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <i class="fas fa-mobile-alt why-icon"></i>
                    <h4>سهولة الاستخدام</h4>
                    <p>واجهة بسيطة وسهلة للحجز من أي جهاز</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="container my-5">
    <div class="cta-card animate__animated animate__pulse animate__infinite animate__slow">
        <div class="cta-content text-center">
            <h2 class="display-4 fw-bold mb-4">
                جاهز لبدء رحلتك؟
            </h2>
            <p class="lead mb-4">
                احجز أول حصة تدريبية الآن واحصل على خصم 10%
            </p>
            <a href="{{ route('instructors.search') }}" class="btn cta-btn">
                <i class="fas fa-rocket me-2"></i>
                ابدأ الآن
            </a>
        </div>
    </div>
</section>


@endsection

@push('styles')
<style>
        :root {
    --primary: #7B1E3A;
    --secondary: #F5EFEA;
    --dark: #2E2E2E;
    --muted: #6C6C6C;
}


.custom-btn {
    border-radius: 25px;
    padding: 15px 40px;
    font-weight: 700;
    border-width: 3px;
}



/* نصوص ثانوية */
.text-muted {
    color: var(--muted) !important;
}

/* الأزرار */
.btn-primary {
    background-color: var(--primary);
    border-color: var(--primary);
    border-radius: 30px;
    padding: 12px 35px;
    font-weight: 700;
}

.btn-primary:hover {
    background-color: #64172F;
    border-color: #64172F;
}

.btn-outline-light {
    border-radius: 30px;
    font-weight: 700;
}

/* Hero Section */
.hero-section {
    background-color: var(--secondary);
    padding: 80px 0;
}



/* الأيقونات */
.stat-icon {
    background-color: var(--primary) !important;
    color: white;
    border-radius: 50%;
}

/* النجوم */
.rating-stars i {
    color: #C9A24D;
}

/* البادجات */
.badge.bg-info,
.badge.bg-success {
    background-color: var(--secondary) !important;
    color: var(--primary);
    font-weight: 600;
}

/* Sections هادئة */
section {
    padding-top: 60px;
    padding-bottom: 60px;
}



/* Links */
a {
    text-decoration: none;
}


    /* Additional hover effects */
    .stat-card:hover .stat-icon {
        transform: rotate(360deg) scale(1.1);
        transition: all 0.5s ease;
    }
    
    .card:hover {
        box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
    }
    
    .instructor-card:hover .instructor-img {
        transform: scale(1.1);
        transition: all 0.3s;
    }
</style>
@endpush