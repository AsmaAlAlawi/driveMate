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
                إعادة تعيين كلمة المرور
            </h2>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                        :value="old('email', $request->email)"
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
                        autocomplete="new-password"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label
                        for="password_confirmation"
                        :value="__('Confirm Password')"
                        class="text-[#6D1B2D] font-semibold"
                    />

                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full rounded-lg border-gray-300
                               focus:border-[#6D1B2D] focus:ring-[#6D1B2D]"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-[#6D1B2D] text-white font-semibold
                               hover:bg-[#581525] transition duration-300 shadow-md"
                    >
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
