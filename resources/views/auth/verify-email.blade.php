<x-guest-layout>
    <style>
        /* إخفاء شعار Laravel */
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
                تحقق من بريدك الإلكتروني
            </h2>

            <p class="mb-6 text-sm text-gray-600 text-center">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-700 bg-green-100 rounded-lg p-3">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-[#6D1B2D] text-white font-semibold
                               hover:bg-[#581525] transition duration-300 shadow-md"
                    >
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="underline text-sm text-[#6D1B2D] hover:text-[#3f0d1a] rounded-md
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6D1B2D]"
                    >
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
