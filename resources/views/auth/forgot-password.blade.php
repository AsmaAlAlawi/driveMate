<x-guest-layout>
    <style>
        svg[class*="logo"], .logo, .shrink-0 {
            display: none !important;
        }
    </style>

    <div class="min-h-screen flex items-center justify-center bg-[#F5F1EB] px-4">
        <div
            class="w-full max-w-md bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8 border border-[#e6dfd6]"
        >
            <!-- العنوان -->
            <h2 class="text-2xl font-bold text-[#6D1B2D] mb-2 text-center">
                استعادة كلمة المرور
            </h2>

            <p class="mb-6 text-sm text-gray-600 text-center">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status
                class="mb-4 text-sm text-green-700 bg-green-100 rounded-lg p-3"
                :status="session('status')"
            />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label
                        for="email"
                        :value="__('Email')"
                        class="text-[#6D1B2D] font-semibold"
                    />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full rounded-lg border-gray-300
                               focus:border-[#6D1B2D] focus:ring-[#6D1B2D]"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                    />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-[#6D1B2D] text-white font-semibold
                               hover:bg-[#581525] transition duration-300 shadow-md"
                    >
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
