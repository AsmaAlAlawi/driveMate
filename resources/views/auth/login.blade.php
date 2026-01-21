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

            /* العناوين */
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

            /* checkbox */
            .auth-checkbox {
                color: #6D1B2D;
            }

            /* زر الدخول */
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
                color: #581525;
                border-radius: 0.75rem;
            }
        </style>
    @endpush

    <!-- Background -->
    <div class="min-h-screen flex items-center justify-center auth-bg px-4">

        <!-- Card -->
        <div class="w-full max-w-md p-8 auth-card">

            <!-- Title -->
            <h2 class="text-2xl font-bold text-center mb-6 auth-title">
                تسجيل الدخول
            </h2>

            <!-- Session Status -->
            <x-auth-session-status
                class="mb-4 p-3 text-sm auth-success"
                :status="session('status')"
            />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
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
                        autocomplete="username"
                        class="block w-full auth-input"
                    />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label
                        for="password"
                        :value="__('Password')"
                        class="font-semibold mb-1 auth-title"
                    />

                    <x-text-input
                          id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="block w-full auth-input"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input
                            id="remember_me"
                                type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 auth-checkbox focus:ring-[#6D1B2D]"
                        >
                        <span class="ms-2 text-sm auth-text">
                            {{ __('Remember me') }}
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            class="text-sm auth-title hover:underline"
                        >
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-7 py-2.5 font-semibold auth-btn">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-guest-layout>
