@extends('layouts.app')

@section('title', 'سياسة الخصوصية - Drive Mate')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="card border-0 mb-4" style="background: linear-gradient(135deg, var(--primary-burgundy) 0%, var(--light-burgundy) 100%);">
                <div class="card-body text-center py-5">
                    <i class="fas fa-shield-alt fa-4x text-white mb-3"></i>
                    <h1 class="text-white fw-bold mb-2">سياسة الخصوصية</h1>
                    <p class="text-white-50 mb-0">آخر تحديث: {{ date('d/m/Y') }}</p>
                </div>
            </div>

            <!-- Content -->
            <div class="card">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- المقدمة -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-info-circle me-2"></i> المقدمة
                        </h3>
                        <p class="text-muted lh-lg">
                            نحن في <strong>Drive Mate</strong> نلتزم بحماية خصوصيتك. توضح سياسة الخصوصية هذه كيفية جمعنا واستخدامنا وحمايتنا للمعلومات الشخصية التي تقدمها لنا عند استخدام منصتنا لحجز مدربي تعليم القيادة.
                        </p>
                    </section>

                    <hr class="my-4">

                    <!-- المعلومات التي نجمعها -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-database me-2"></i> المعلومات التي نجمعها
                        </h3>
                        
                        <h5 class="fw-bold mb-3">1. المعلومات الشخصية</h5>
                        <ul class="text-muted lh-lg">
                            <li>الاسم الكامل</li>
                            <li>البريد الإلكتروني</li>
                            <li>رقم الهاتف</li>
                            <li>تاريخ الميلاد (للمتدربين)</li>
                            <li>معلومات الحساب (اسم المستخدم وكلمة المرور المشفرة)</li>
                        </ul>

                        <h5 class="fw-bold mb-3 mt-4">2. معلومات المدربين</h5>
                        <ul class="text-muted lh-lg">
                            <li>رقم رخصة التدريب</li>
                            <li>سنوات الخبرة</li>
                            <li>المنطقة الجغرافية</li>
                            <li>الأسعار والتوفر</li>
                            <li>الصورة الشخصية (اختياري)</li>
                        </ul>

                        <h5 class="fw-bold mb-3 mt-4">3. معلومات الحجز والدفع</h5>
                        <ul class="text-muted lh-lg">
                            <li>تفاصيل الحجوزات (التاريخ، الوقت، المدة)</li>
                            <li>معلومات الدفع (تُعالج عبر بوابة ثواني الآمنة)</li>
                            <li>حالة الدفع والمدفوعات</li>
                        </ul>

                        <h5 class="fw-bold mb-3 mt-4">4. المعلومات التقنية</h5>
                        <ul class="text-muted lh-lg">
                            <li>عنوان IP</li>
                            <li>نوع المتصفح</li>
                            <li>نظام التشغيل</li>
                            <li>تاريخ ووقت الزيارة</li>
                        </ul>
                    </section>

                    <hr class="my-4">

                    <!-- كيفية استخدام المعلومات -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-cogs me-2"></i> كيفية استخدام المعلومات
                        </h3>
                        <p class="text-muted lh-lg">نستخدم معلوماتك الشخصية للأغراض التالية:</p>
                        <ul class="text-muted lh-lg">
                            <li>إنشاء وإدارة حسابك على المنصة</li>
                            <li>معالجة حجوزات الدروس ومعاملات الدفع</li>
                            <li>التواصل معك بخصوص حجوزاتك وخدماتنا</li>
                            <li>تحسين جودة خدماتنا وتجربة المستخدم</li>
                            <li>إرسال إشعارات مهمة حول حسابك أو خدماتنا</li>
                            <li>الامتثال للمتطلبات القانونية والتنظيمية</li>
                            <li>منع الاحتيال وضمان أمان المنصة</li>
                        </ul>
                    </section>

                    <hr class="my-4">

                    <!-- مشاركة المعلومات -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-share-alt me-2"></i> مشاركة المعلومات
                        </h3>
                        <p class="text-muted lh-lg">نحن لا نبيع أو نؤجر معلوماتك الشخصية لأطراف ثالثة. قد نشارك معلوماتك فقط في الحالات التالية:</p>
                        
                        <div class="alert alert-info">
                            <h6 class="fw-bold">
                                <i class="fas fa-user-tie me-2"></i> مع المدربين
                            </h6>
                            <p class="mb-0 small">مشاركة معلومات الاتصال الأساسية مع المدرب المحجوز لتنسيق الدروس</p>
                        </div>

                        <div class="alert alert-info">
                            <h6 class="fw-bold">
                                <i class="fas fa-credit-card me-2"></i> بوابات الدفع
                            </h6>
                            <p class="mb-0 small">معالجة المدفوعات عبر بوابة ثواني الآمنة والمعتمدة</p>
                        </div>

                        <div class="alert alert-info">
                            <h6 class="fw-bold">
                                <i class="fas fa-balance-scale me-2"></i> الجهات القانونية
                            </h6>
                            <p class="mb-0 small">عند الحاجة للامتثال للقوانين أو حماية حقوقنا</p>
                        </div>
                    </section>

                    <hr class="my-4">

                    <!-- حماية المعلومات -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-lock me-2"></i> حماية المعلومات
                        </h3>
                        <p class="text-muted lh-lg">نطبق إجراءات أمنية صارمة لحماية معلوماتك:</p>
                        <ul class="text-muted lh-lg">
                            <li>تشفير جميع البيانات الحساسة باستخدام بروتوكول SSL/TLS</li>
                            <li>تخزين كلمات المرور بشكل مشفر باستخدام خوارزميات قوية</li>
                            <li>تقييد الوصول إلى المعلومات الشخصية للموظفين المصرح لهم فقط</li>
                            <li>المراقبة المستمرة للأنظمة لاكتشاف التهديدات الأمنية</li>
                            <li>إجراء نسخ احتياطية منتظمة للبيانات</li>
                        </ul>
                    </section>

                    <hr class="my-4">

                    <!-- حقوقك -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-user-shield me-2"></i> حقوقك
                        </h3>
                        <p class="text-muted lh-lg">لديك الحقوق التالية فيما يتعلق ببياناتك الشخصية:</p>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold"><i class="fas fa-eye me-2 text-primary"></i> الوصول</h6>
                                        <p class="small text-muted mb-0">طلب نسخة من بياناتك الشخصية</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold"><i class="fas fa-edit me-2 text-warning"></i> التصحيح</h6>
                                        <p class="small text-muted mb-0">تحديث أو تصحيح معلوماتك</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold"><i class="fas fa-trash me-2 text-danger"></i> الحذف</h6>
                                        <p class="small text-muted mb-0">طلب حذف بياناتك الشخصية</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold"><i class="fas fa-ban me-2 text-secondary"></i> الاعتراض</h6>
                                        <p class="small text-muted mb-0">الاعتراض على معالجة بياناتك</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <hr class="my-4">

                    <!-- ملفات تعريف الارتباط -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-cookie-bite me-2"></i> ملفات تعريف الارتباط (Cookies)
                        </h3>
                        <p class="text-muted lh-lg">
                            نستخدم ملفات تعريف الارتباط لتحسين تجربتك على المنصة. يمكنك التحكم في ملفات تعريف الارتباط من خلال إعدادات المتصفح الخاص بك.
                        </p>
                    </section>

                    <hr class="my-4">

                    <!-- التواصل -->
                    <section class="mb-4">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-envelope me-2"></i> تواصل معنا
                        </h3>
                        <p class="text-muted lh-lg">
                            إذا كان لديك أي استفسارات حول سياسة الخصوصية أو ترغب في ممارسة حقوقك، يرجى التواصل معنا:
                        </p>
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <p class="mb-2"><i class="fas fa-envelope me-2"></i> <strong>البريد الإلكتروني:</strong> privacy@drivemate.om</p>
                                <p class="mb-0"><i class="fas fa-phone me-2"></i> <strong>الهاتف:</strong> +968 1234 5678</p>
                            </div>
                        </div>
                    </section>

                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-arrow-right me-2"></i> العودة للرئيسية
                </a>
            </div>
        </div>
    </div>
</div>
@endsection