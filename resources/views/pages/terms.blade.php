@extends('layouts.app')

@section('title', 'شروط الاستخدام - Drive Mate')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="card border-0 mb-4" style="background: linear-gradient(135deg, var(--light-burgundy) 0%, var(--primary-burgundy) 100%);">
                <div class="card-body text-center py-5">
                    <i class="fas fa-file-contract fa-4x text-white mb-3"></i>
                    <h1 class="text-white fw-bold mb-2">شروط الاستخدام</h1>
                    <p class="text-white-50 mb-0">آخر تحديث: {{ date('d/m/Y') }}</p>
                </div>
            </div>

            <!-- Content -->
            <div class="card">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- المقدمة -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-handshake me-2"></i> الموافقة على الشروط
                        </h3>
                        <p class="text-muted lh-lg">
                            مرحباً بك في <strong>Drive Mate</strong>. باستخدامك لمنصتنا، فإنك توافق على الالتزام بشروط الاستخدام هذه. يرجى قراءة هذه الشروط بعناية قبل استخدام خدماتنا.
                        </p>
                    </section>

                    <hr class="my-4">

                    <!-- تعريف الخدمة -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-info-circle me-2"></i> تعريف الخدمة
                        </h3>
                        <p class="text-muted lh-lg">
                            Drive Mate هي منصة إلكترونية تربط بين المتدربين ومدربي تعليم القيادة في سلطنة عمان. نوفر:
                        </p>
                        <ul class="text-muted lh-lg">
                            <li>نظام حجز مواعيد الدروس التدريبية</li>
                            <li>معلومات عن المدربين المعتمدين</li>
                            <li>نظام دفع إلكتروني آمن</li>
                            <li>نظام تقييمات ومراجعات</li>
                        </ul>
                    </section>

                    <hr class="my-4">

                    <!-- التسجيل واستخدام الحساب -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-user-plus me-2"></i> التسجيل واستخدام الحساب
                        </h3>
                        
                        <h5 class="fw-bold mb-3">1. متطلبات التسجيل</h5>
                        <ul class="text-muted lh-lg">
                            <li>يجب أن يكون عمرك 18 عاماً على الأقل للتسجيل كمتدرب</li>
                            <li>يجب تقديم معلومات صحيحة ودقيقة عند التسجيل</li>
                            <li>للمدربين: يجب تقديم رخصة تدريب سارية المفعول</li>
                        </ul>

                        <h5 class="fw-bold mb-3 mt-4">2. مسؤولية الحساب</h5>
                        <ul class="text-muted lh-lg">
                            <li>أنت مسؤول عن الحفاظ على سرية كلمة المرور الخاصة بك</li>
                            <li>أنت مسؤول عن جميع الأنشطة التي تتم من خلال حسابك</li>
                            <li>يجب إخطارنا فوراً بأي استخدام غير مصرح به لحسابك</li>
                        </ul>
                    </section>

                    <hr class="my-4">

                    <!-- الحجز والدفع -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-calendar-check me-2"></i> الحجز والدفع
                        </h3>
                        
                        <div class="alert alert-warning">
                            <h6 class="fw-bold"><i class="fas fa-exclamation-triangle me-2"></i> تأكيد الحجز</h6>
                            <p class="mb-0 small">يتم تأكيد الحجز فقط بعد إتمام عملية الدفع بنجاح</p>
                        </div>

                        <h5 class="fw-bold mb-3">سياسة الإلغاء</h5>
                        <ul class="text-muted lh-lg">
                            <li>يمكن إلغاء الحجز قبل 24 ساعة من موعد الدرس مع استرداد كامل المبلغ</li>
                            <li>الإلغاء قبل أقل من 24 ساعة قد يؤدي إلى فقدان المبلغ المدفوع</li>
                            <li>عدم الحضور للدرس المحجوز يعني فقدان كامل المبلغ</li>
                        </ul>

                        <h5 class="fw-bold mb-3 mt-4">المدفوعات</h5>
                        <ul class="text-muted lh-lg">
                            <li>جميع المدفوعات تتم عبر بوابة ثواني الآمنة</li>
                            <li>الأسعار المعروضة نهائية وتشمل جميع الرسوم</li>
                            <li>نحن لا نخزن معلومات بطاقتك الائتمانية</li>
                        </ul>
                    </section>

                    <hr class="my-4">

                    <!-- التزامات المستخدمين -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-clipboard-check me-2"></i> التزامات المستخدمين
                        </h3>
                        
                        <h5 class="fw-bold mb-3">للمتدربين:</h5>
                        <ul class="text-muted lh-lg">
                            <li>الالتزام بمواعيد الدروس المحجوزة</li>
                            <li>احترام المدرب واتباع تعليماته</li>
                            <li>تقديم تقييمات صادقة ومهنية</li>
                            <li>الالتزام بقواعد السلامة المرورية</li>
                        </ul>

                        <h5 class="fw-bold mb-3 mt-4">للمدربين:</h5>
                        <ul class="text-muted lh-lg">
                            <li>تقديم خدمات تدريبية عالية الجودة</li>
                            <li>الحفاظ على رخصة التدريب سارية المفعول</li>
                            <li>الالتزام بمواعيد الدروس المتفق عليها</li>
                            <li>معاملة المتدربين باحترام ومهنية</li>
                            <li>الحفاظ على سلامة المركبة المستخدمة في التدريب</li>
                        </ul>
                    </section>

                    <hr class="my-4">

                    <!-- السلوك المحظور -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-ban me-2"></i> السلوك المحظور
                        </h3>
                        <p class="text-muted lh-lg">يُمنع منعاً باتاً:</p>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card border-danger">
                                    <div class="card-body">
                                        <h6 class="text-danger fw-bold">
                                            <i class="fas fa-times-circle me-2"></i> محظور
                                        </h6>
                                        <ul class="small text-muted mb-0">
                                            <li>انتحال الشخصية أو تقديم معلومات كاذبة</li>
                                            <li>التحايل أو الاحتيال في المدفوعات</li>
                                            <li>إساءة استخدام المنصة لأغراض غير قانونية</li>
                                            <li>نشر محتوى مسيء أو غير لائق</li>
                                            <li>محاولة اختراق أو تعطيل المنصة</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-body">
                                        <h6 class="text-success fw-bold">
                                            <i class="fas fa-check-circle me-2"></i> مسموح
                                        </h6>
                                        <ul class="small text-muted mb-0">
                                            <li>استخدام المنصة للأغراض المشروعة</li>
                                            <li>التواصل المهني والمحترم</li>
                                            <li>تقديم ملاحظات بناءة</li>
                                            <li>الإبلاغ عن أي مشاكل تقنية</li>
                                            <li>طلب الدعم الفني عند الحاجة</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <hr class="my-4">

                    <!-- الملكية الفكرية -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-copyright me-2"></i> الملكية الفكرية
                        </h3>
                        <p class="text-muted lh-lg">
                            جميع المحتويات والعلامات التجارية والشعارات الموجودة على المنصة هي ملك لـ Drive Mate أو مرخصة لنا. يُمنع استخدامها دون إذن كتابي مسبق.
                        </p>
                    </section>

                    <hr class="my-4">

                    <!-- إخلاء المسؤولية -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-exclamation-triangle me-2"></i> إخلاء المسؤولية
                        </h3>
                        <div class="alert alert-info">
                            <p class="mb-0 lh-lg">
                                Drive Mate هي منصة وساطة بين المتدربين والمدربين. نحن لا نتحمل مسؤولية:
                            </p>
                            <ul class="mt-2 mb-0">
                                <li>جودة الخدمات التدريبية المقدمة من المدربين</li>
                                <li>أي حوادث أو إصابات تحدث أثناء الدروس التدريبية</li>
                                <li>النزاعات المباشرة بين المتدربين والمدربين</li>
                                <li>فقدان أو تلف الممتلكات الشخصية</li>
                            </ul>
                        </div>
                    </section>

                    <hr class="my-4">

                    <!-- التعديلات على الشروط -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">
                            <i class="fas fa-edit me-2"></i> التعديلات على الشروط
                        </h3>
                        <p class="text-muted lh-lg">
                            نحتفظ بالحق في تعديل شروط الاستخدام في أي وقت. سيتم إخطارك بأي تغييرات جوهرية عبر البريد الإلكتروني أو من خلال إشعار على المنصة.
                        </p>
                    </section>

                    <hr class="my-4">

                    <!-- القانون الحاكم -->
                    <section class="mb-5">
                        <h3 class="fw-bold mb-3" style="color: var(--primary-burgundy);">