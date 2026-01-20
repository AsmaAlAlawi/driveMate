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
            <h2 class="text-2xl font-bold text-[#6D1B2D] mb-6 text-center">
                تسجيل الدخول
            </h2>

            <!-- Session Status -->
            <x-auth-session-status
                class="mb-4 text-sm text-green-700 bg-green-100 rounded-lg p-3"
                :status="session('status')"
            />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
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
                        autocomplete="username"
                    />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label
                        for="password"
                        :value="__('Password')"
                        class="text-[#6D1B2D] font-semibold"
                    />

                    <x-text-input
                        id="password"
                        class="block mt-1 w-full rounded-lg border-gray-300
                               focus:border-[#6D1B2D] focus:ring-[#6D1B2D]"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-gray-300 text-[#6D1B2D]
                                   focus:ring-[#6D1B2D]"
                            name="remember"
                        >
                        <span class="ms-2 text-sm text-gray-600">
                            {{ __('Remember me') }}
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            class="text-sm text-[#6D1B2D] hover:underline"
                        >
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-[#6D1B2D] text-white font-semibold
                               hover:bg-[#581525] transition duration-300 shadow-md"
                    >
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
