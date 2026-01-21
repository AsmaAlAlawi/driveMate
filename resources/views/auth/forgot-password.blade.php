<x-guest-layout>

    @push('styles')
        <style>
            /* إخفاء اللوقو */
            svg[class*="logo"], .logo, .shrink-0 {
                display: none !important;
            }

            /* الخلفية */
            .auth-bg {
                background-color: #F3EEE8;
            }

            /* الكرت */
            .auth-card {
                background-color: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(14px);
                border-radius: 1.75rem;
                border: 1px solid #e3d9cf;
                box-shadow: 0 20px 40px rgba(109, 27, 45, 0.15);
            }

            /* العنوان */
            .auth-title {
                color: #6D1B2D;
            }

            /* النص */
            .auth-text {
                color: #6b6460;
            }

            /* الحقول */
            .auth-input {
                border-radius: 0.75rem;
                border-color: #d6c9bf;
                background-color: rgba(255, 255, 255, 0.85);
            }

            .auth-input:focus {
                border-color: #6D1B2D;
                box-shadow: 0 0 0 1px #6D1B2D;
            }

            /* زر الإرسال */
            .auth-btn {
                background-color: #6D1B2D;
                color: #fff;
                border-radius: 0.75rem;
                box-shadow: 0 10px 20px rgba(109, 27, 45, 0.3);
                transition: all 0.3s ease;
            }

            .auth-btn:hover {
                background-color: #581525;
                box-shadow: 0 14px 28px rgba(109, 27, 45, 0.4);
            }

            /* رسالة النجاح */
            .auth-success {
                background-color: #edf7f1;
                color: #1f7a4d;
                border-radius: 0.75rem;
            }
        </style>
    @endpush

    <!-- Background -->
    <div class="min-h-screen flex items-center justify-center auth-bg px-4">

        <!-- Card -->
        <div class="w-full max-w-md p-8 auth-card">

            <!-- Title -->
            <h2 class="text-2xl font-bold text-center mb-3 auth-title">
                استعادة كلمة المرور
            </h2>

            <!-- Description -->
            <p class="text-sm text-center mb-6 leading-relaxed auth-text">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status
                class="mb-4 p-3 text-sm auth-success"
                :status="session('status')"
            />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label
                        for="email"
                        :value="__('Email')"
                        class="font-semibold mb-1 auth-title"
                    />

                    <x-text-input
                            id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        class="block w-full auth-input"
                    />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-7 py-2.5 font-semibold auth-btn">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-guest-layout>
