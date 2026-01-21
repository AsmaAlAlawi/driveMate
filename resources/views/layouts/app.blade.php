<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Drive Mate - رفيقك في تعلم القيادة')</title>
    
    <!-- Bootstrap 5 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts - Tajawal (خط عربي أنيق) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        :root {
            /* ألوان عنابي هادئة */
            --primary-burgundy: #6b2737;
            --light-burgundy: #8d4356;
            --dark-burgundy: #4a1a26;
            --burgundy-glow: rgba(107, 39, 55, 0.3);
            
            /* ألوان مساعدة */
            --cream-bg: #faf7f5;
            --soft-white: #ffffff;
            --text-dark: #2d2d2d;
            --text-muted: #7a7a7a;
            
            /* ظلال ناعمة */
            --soft-shadow: 0 4px 15px rgba(107, 39, 55, 0.08);
            --hover-shadow: 0 8px 25px rgba(107, 39, 55, 0.15);
        }
        
        * {
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: var(--cream-bg);
            color: var(--text-dark);
            min-height: 100vh;
            line-height: 1.8;
        }
        
        /* ===== NAVBAR ===== */
        .navbar-burgundy {
            background: linear-gradient(135deg, var(--primary-burgundy) 0%, var(--dark-burgundy) 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 15px var(--burgundy-glow);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }
        
        /* الشعار المميز */
        .logo-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
        }
        
        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #fff 0%, #f5f5f5 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: pulseGlow 3s ease-in-out infinite;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }
        
        .logo-icon i {
            font-size: 1.5rem;
            color: var(--primary-burgundy);
            animation: bounce 2s ease-in-out infinite;
        }
        
        /* توهج الشعار */
        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(255, 255, 255, 0.3),
                           0 0 40px rgba(255, 255, 255, 0.1);
            }
            50% {
                box-shadow: 0 0 30px rgba(255, 255, 255, 0.5),
                           0 0 60px rgba(255, 255, 255, 0.2);
            }
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        
        .logo-main {
            font-size: 1.5rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .logo-sub {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 400;
            letter-spacing: 2px;
        }

        /* Page spacing under navbar */
.page-content {
    margin-top: 2.5rem;
}
        
        /* روابط الـ Navbar */
        .navbar-burgundy .nav-link {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            padding: 8px 18px;
            margin: 0 5px;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .navbar-burgundy .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            transform: translateY(-2px);
        }
        
        .navbar-burgundy .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            right: 50%;
            width: 0;
            height: 2px;
            background: #fff;
            transition: all 0.3s ease;
            transform: translateX(50%);
        }
        
        .navbar-burgundy .nav-link:hover::before {
            width: 70%;
        }
        
        /* أزرار تسجيل الدخول */
        .btn-auth-outline {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 25px;
            padding: 8px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .btn-auth-outline:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #fff;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        }
        
        .btn-auth {
            background: #fff;
            color: var(--primary-burgundy);
            border: 2px solid #fff;
            border-radius: 25px;
            padding: 8px 24px;
            font-weight: 700;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .btn-auth:hover {
            background: var(--cream-bg);
            color: var(--dark-burgundy);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }
        
        /* ===== CARDS ===== */
        .card {
            border: none;
            border-radius: 16px;
            background: var(--soft-white);
            box-shadow: var(--soft-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            box-shadow: var(--hover-shadow);
            transform: translateY(-5px);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-burgundy) 0%, var(--light-burgundy) 100%);
            color: white;
            font-weight: 700;
            padding: 1.25rem;
            border: none;
        }
        
        /* ===== BUTTONS ===== */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-burgundy) 0%, var(--light-burgundy) 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 32px;
            font-weight: 600;
            color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px var(--burgundy-glow);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px var(--burgundy-glow);
            background: linear-gradient(135deg, var(--light-burgundy) 0%, var(--primary-burgundy) 100%);
        }
        
     
        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-weight: 600;
        }
        
        /* ===== ALERTS ===== */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: var(--soft-shadow);
            animation: slideInDown 0.5s ease;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
        }
        
        /* ===== FOOTER ===== */
        .footer {
            background: linear-gradient(135deg, var(--dark-burgundy) 0%, var(--primary-burgundy) 100%);
            color: #fff;
            padding: 3rem 0 1.5rem;
            margin-top: 5rem;
            box-shadow: 0 -4px 20px var(--burgundy-glow);
        }
        
        .footer h5 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 12px;
        }
        
        .footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60px;
            height: 3px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 2px;
        }
        
        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            margin-bottom: 10px;
        }
        
        .footer a:hover {
            color: #fff;
            padding-right: 8px;
        }
        
        .social-icon {
            width: 42px;
            height: 42px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 6px;
            transition: all 0.3s ease;
            color: #fff;
        }
        
        .social-icon:hover {
            background: #fff;
            color: var(--primary-burgundy);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }
        
        /* ===== BADGE ===== */
        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        /* ===== RATING STARS ===== */
        .rating-stars {
            color: #ffa726;
            font-size: 1rem;
        }
        
        /* ===== STATS CARD ===== */
        .stat-card {
            background: var(--soft-white);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--soft-shadow);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
        }
        
        .stat-icon {
            width: 75px;
            height: 75px;
            background: linear-gradient(135deg, var(--primary-burgundy) 0%, var(--light-burgundy) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 4px 12px var(--burgundy-glow);
        }
        
        /* ===== INSTRUCTOR CARD ===== */
        .instructor-card {
            background: var(--soft-white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--soft-shadow);
            transition: all 0.3s ease;
        }
        
        .instructor-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
        }
        
        .instructor-img {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            margin: -55px auto 20px;
        }
        
        /* ===== MODAL ===== */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 50px rgba(107, 39, 55, 0.2);
        }
        
        .modal-body .form-control:focus,
        .modal-body .form-select:focus {
            border-color: var(--primary-burgundy);
            box-shadow: 0 0 0 0.25rem var(--burgundy-glow);
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .logo-main {
                font-size: 1.2rem;
            }
            
            .logo-icon {
                width: 38px;
                height: 38px;
            }
            
            .logo-icon i {
                font-size: 1.2rem;
            }
        }
        
        /* ===== ANIMATIONS ===== */
        @keyframes slideInDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--cream-bg);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-burgundy);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--dark-burgundy);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-burgundy">
        <div class="container">
            <!-- الشعار -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="logo-wrapper animate__animated animate__fadeIn">
                    <div class="logo-icon">
                        <i class="fas fa-car-side"></i>
                    </div>
                    <div class="logo-text">
                        <span class="logo-main">Drive Mate</span>
                        <span class="logo-sub">رفيقك في تعلم القيادة</span>
                    </div>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border: 2px solid #fff;">
                <i class="fas fa-bars text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> الرئيسية
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('instructors.index') }}">
                            <i class="fas fa-users me-1"></i> المدربين
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('instructors.search') }}">
                            <i class="fas fa-search me-1"></i> بحث متقدم
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-1"></i> لوحة التحكم
                                </a>
                            </li>
                        @endif
                        
                        @if(Auth::user()->isInstructor())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('bookings.instructor-bookings') }}">
                                    <i class="fas fa-calendar-check me-1"></i> حجوزاتي
                                </a>
                            </li>
                        @endif
                        
                        @if(Auth::user()->isStudent())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('bookings.my-bookings') }}">
                                    <i class="fas fa-calendar me-1"></i> حجوزاتي
                                </a>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 12px;">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user me-2"></i> الملف الشخصي
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <button type="button" class="btn btn-auth-outline" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="fas fa-sign-in-alt me-1"></i> تسجيل الدخول
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-auth" data-bs-toggle="modal" data-bs-target="#registerModal">
                                <i class="fas fa-user-plus me-1"></i> تسجيل جديد
                            </button>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success') || session('error') || $errors->any())
        <div class="container mt-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle fa-lg me-2"></i>
                    <strong>رائع!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle fa-lg me-2"></i>
                    <strong>عذراً!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle fa-lg me-2"></i>
                    <strong>يوجد أخطاء:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="logo-wrapper mb-3">
                        <div class="logo-icon">
                            <i class="fas fa-car-side"></i>
                        </div>
                        <div class="logo-text">
                            <span class="logo-main">Drive Mate</span>
                            <span class="logo-sub">رفيقك في تعلم القيادة</span>
                        </div>
                    </div>
                    <p class="text-white-50">
                        أفضل منصة لحجز مدربي تعليم القيادة في سلطنة عمان. نوفر لك تجربة تعليمية متميزة مع أفضل المدربين.
                    </p>
                    <div class="mt-3">
                     
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>روابط سريعة</h5>
                    <a href="{{ route('home') }}"><i class="fas fa-chevron-left me-2"></i> الرئيسية</a>
                    <a href="{{ route('instructors.index') }}"><i class="fas fa-chevron-left me-2"></i> المدربين</a>
                    <a href="{{ route('instructors.search') }}"><i class="fas fa-chevron-left me-2"></i> البحث</a>
                    @auth
                        <a href="{{ route('bookings.my-bookings') }}"><i class="fas fa-chevron-left me-2"></i> حجوزاتي</a>
                    @endauth
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>خدماتنا</h5>
                    <a href="#"><i class="fas fa-chevron-left me-2"></i> تعليم القيادة للمبتدئين</a>
                    <a href="#"><i class="fas fa-chevron-left me-2"></i> تدريب القيادة الدفاعية</a>
                    <a href="#"><i class="fas fa-chevron-left me-2"></i> دروس القيادة المتقدمة</a>
                    <a href="#"><i class="fas fa-chevron-left me-2"></i> استشارات القيادة</a>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>تواصل معنا</h5>
                    <p class="text-white-50">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        مسقط، سلطنة عمان
                    </p>
                    <p class="text-white-50">
                        <i class="fas fa-phone me-2"></i>
                        <a href="tel:+96812345678" class="text-white-50 d-inline">+968 1234 5678</a>
                    </p>
                    <p class="text-white-50">
                        <i class="fas fa-envelope me-2"></i>
                        <a href="mailto:info@drivemate.om" class="text-white-50 d-inline">info@drivemate.om</a>
                    </p>
                </div>
            </div>
            
            <hr style="border-color: rgba(255,255,255,0.2); margin: 2rem 0 1rem;">
            
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="text-white-50 mb-0">
                        &copy; {{ date('Y') }} Drive Mate. جميع الحقوق محفوظة
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white-50 me-3 d-inline">سياسة الخصوصية</a>
                    <a href="#" class="text-white-50 d-inline">شروط الاستخدام</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--primary-burgundy) 0%, var(--light-burgundy) 100%);">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-sign-in-alt me-2"></i> تسجيل الدخول
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="login-email" class="form-label">
                                <i class="fas fa-envelope me-2" style="color: var(--primary-burgundy);"></i> البريد الإلكتروني
                            </label>
                            <input type="email" class="form-control form-control-lg" id="login-email" name="email" required autofocus placeholder="example@email.com" style="border-radius: 12px;">
                        </div>

                        <div class="mb-3">
                            <label for="login-password" class="form-label">
                                <i class="fas fa-lock me-2" style="color: var(--primary-burgundy);"></i> كلمة المرور
                            </label>
                            <input type="password" class="form-control form-control-lg" id="login-password" name="password" required placeholder="••••••••" style="border-radius: 12px;">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">تذكرني</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i> دخول
                                    </button>
                                        @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" class="text-muted">
                                <i class="fas fa-question-circle me-1"></i> نسيت كلمة المرور؟
                            </a>
                        </div>
                    @endif
                </form>

                <hr class="my-4">

                <div class="text-center">
                    <p class="text-muted mb-0">
                        ليس لديك حساب؟ 
                        <a href="#" class="fw-bold" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal" style="color: var(--primary-burgundy);">
                            سجل الآن
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--light-burgundy) 0%, var(--primary-burgundy) 100%);">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-user-plus me-2"></i> إنشاء حساب جديد
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="register-name" class="form-label">
                                <i class="fas fa-user me-2" style="color: var(--primary-burgundy);"></i> الاسم الكامل
                            </label>
                            <input type="text" class="form-control form-control-lg" id="register-name" name="name" required placeholder="أحمد محمد" style="border-radius: 12px;">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="register-email" class="form-label">
                                <i class="fas fa-envelope me-2" style="color: var(--primary-burgundy);"></i> البريد الإلكتروني
                            </label>
                            <input type="email" class="form-control form-control-lg" id="register-email" name="email" required placeholder="example@email.com" style="border-radius: 12px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="register-role" class="form-label">
                            <i class="fas fa-user-tag me-2" style="color: var(--primary-burgundy);"></i> نوع الحساب
                        </label>
                        <select class="form-select form-select-lg" id="register-role" name="role" required style="border-radius: 12px;">
                            <option value="student">متدرب - أريد تعلم القيادة</option>
                            <option value="instructor">مدرب - أريد تقديم دروس قيادة</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="register-password" class="form-label">
                                <i class="fas fa-lock me-2" style="color: var(--primary-burgundy);"></i> كلمة المرور
                            </label>
                            <input type="password" class="form-control form-control-lg" id="register-password" name="password" required placeholder="••••••••" style="border-radius: 12px;">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="register-password-confirm" class="form-label">
                                <i class="fas fa-lock me-2" style="color: var(--primary-burgundy);"></i> تأكيد كلمة المرور
                            </label>
                            <input type="password" class="form-control form-control-lg" id="register-password-confirm" name="password_confirmation" required placeholder="••••••••" style="border-radius: 12px;">
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">
                            أوافق على <a href="#" class="fw-bold" style="color: var(--primary-burgundy);">شروط الاستخدام</a> و <a href="#" class="fw-bold" style="color: var(--primary-burgundy);">سياسة الخصوصية</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                        <i class="fas fa-user-plus me-2"></i> إنشاء الحساب
                    </button>
                </form>

                <hr class="my-4">

                <div class="text-center">
                    <p class="text-muted mb-0">
                        لديك حساب بالفعل؟ 
                        <a href="#" class="fw-bold" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal" style="color: var(--primary-burgundy);">
                            سجل دخول
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Auto-hide alerts
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });

    // Show modals on errors
    @if($errors->has('email') || $errors->has('password'))
        document.addEventListener('DOMContentLoaded', function() {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });
    @endif

    @if($errors->has('name') || $errors->has('role') || ($errors->any() && old('name')))
        document.addEventListener('DOMContentLoaded', function() {
            var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
            registerModal.show();
        });
    @endif
</script>

@stack('scripts')
</body>
</html>