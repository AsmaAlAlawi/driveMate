<x-guest-layout>

    @push('styles')
        <style>
            /* إخفاء أي لوقو افتراضي */
            svg[class*="logo"], .logo, .shrink-0 {
                display: none !important;
            }

            /* الخلفية العامة */
            .confirm-bg {
                background-color: #F3EEE8;
            }

            /* الكرت */
            .confirm-card {
                background-color: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(14px);
                border-radius: 1.75rem;
                border: 1px solid #e3d9cf;
                box-shadow: 0 20px 40px rgba(109, 27, 45, 0.15);
            }

            /* العناوين */
            .confirm-title {
                color: #6D1B2D;
            }

            /* النص الوصفي */
            .confirm-text {
                color: #6b6460;
            }

            /* الحقول */
            .confirm-input {
                border-radius: 0.75rem;
                border-color: #d6c9bf;
                background-color: rgba(255, 255, 255, 0.85);
            }

            .confirm-input:focus {
                border-color: #6D1B2D;
                box-shadow: 0 0 0 1px #6D1B2D;
            }

            /* الزر */
            .confirm-btn {
                background-color: #6D1B2D;
                color: #fff;
                border-radius: 0.75rem;
                box-shadow: 0 10px 20px rgba(109, 27, 45, 0.3);
                transition: all 0.3s ease;
            }

            .confirm-btn:hover {
                background-color: #581525;
                box-shadow: 0 14px 28px rgba(109, 27, 45, 0.4);
            }
        </style>
    @endpush

    <!-- Background -->
    <div class="min-h-screen flex items-center justify-center confirm-bg px-4">

        <!-- Card -->
        <div class="w-full max-w-md p-8 confirm-card">

            <!-- Title -->
            <h2 class="text-2xl font-bold text-center mb-3 confirm-title">
                تأكيد كلمة المرور
            </h2>

            <!-- Description -->
            <p class="text-sm text-center mb-6 leading-relaxed confirm-text">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label
                        for="password"
                        :value="__('Password')"
                        class="font-semibold mb-1 confirm-title"
                    />

                    <x-text-input
                            id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="block w-full confirm-input"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-7 py-2.5 font-semibold confirm-btn">
                        {{ __('Confirm') }}
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-guest-layout>
