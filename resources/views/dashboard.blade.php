<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">
            <i class="fas fa-tachometer-alt"></i> لوحة التحكم
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card admin-card">
                <div class="card-body">
                    <div class="text-center">
                        <h3 class="mb-2">مرحباً بك في لوحة التحكم</h3>
                        <p class="text-muted mb-0">تم تسجيل الدخول بنجاح.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .page-title {
            color: #6D1B2D;
            font-weight: 700;
        }

        .admin-card {
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
            border: 0;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            border-radius: 12px;
        }
    </style>
    @endpush
</x-app-layout>
