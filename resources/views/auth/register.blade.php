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

            /* زر التسجيل */
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
        </style>
    @endpush

    <!-- Background -->
    <div class="min-h-screen flex items-center justify-center auth-bg px-4">

        <!-- Card -->
        <div class="w-full max-w-md p-8 auth-card">

            <!-- Title -->
            <h2 class="text-2xl font-bold text-center mb-6 auth-title">
                تسجيل حساب جديد
            </h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label
                        for="name"
                        :value="__('الاسم')"
                        class="font-semibold mb-1 auth-title"
                    />

                    <x-text-input
                          id="name"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        class="block w-full auth-input"
                    />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label
                        for="email"
                        :value="__('البريد الإلكتروني')"
                        class="font-semibold mb-1 auth-title"
                    />

                    <x-text-input
                        id="email"
                            type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                        class="block w-full auth-input"
                    />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Role -->
                <div>
                    <x-input-label
                        for="role"
                        :value="__('نوع الحساب')"
                        class="font-semibold mb-1 auth-title"
                    />

                    <select
                          id="role"
                          name="role"
                        required
                        class="block w-full auth-input"
                    >
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>
                            متدرب
                        </option>
                        <option value="instructor" {{ old('role') == 'instructor' ? 'selected' : '' }}>
                            مدرب
                        </option>
                    </select>

                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label
                        for="password"
                        :value="__('كلمة المرور')"
                        class="font-semibold mb-1 auth-title"
                    />

                    <x-text-input
                          id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="block w-full auth-input"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label
                        for="password_confirmation"
                        :value="__('تأكيد كلمة المرور')"
                        class="font-semibold mb-1 auth-title"
                    />

                    <x-text-input
                          id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="block w-full auth-input"
                    />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-4">
                    <a
                        href="{{ route('login') }}"
                        class="text-sm auth-title hover:underline"
                    >
                        {{ __('لديك حساب بالفعل؟') }}
                    </a>

                    <button type="submit" class="px-7 py-2.5 font-semibold auth-btn">
                        {{ __('تسجيل') }}
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-guest-layout>
