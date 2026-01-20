<nav x-data="{ open: false }" class="bg-[#7a1f2b] border-b border-[#4d0f18]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left -->
            <div class="flex items-center gap-8">
                
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-9 h-9 rounded-lg bg-white text-[#7a1f2b] font-bold flex items-center justify-center shadow">
                            
                        </div>
                        <span class="text-[#e29aa3] font-semibold text-lg">
                            Drive <span class="text-[#f0c8cc]">Mate</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex gap-6">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <x-nav-link class="text-[#e29aa3] hover:text-[#f0c8cc]"
                                :href="route('admin.dashboard')" 
                                :active="request()->routeIs('admin.dashboard')">
                                لوحة التحكم
                            </x-nav-link>

                        @elseif(Auth::user()->isInstructor())
                            <x-nav-link class="text-[#e29aa3] hover:text-[#f0c8cc]"
                                :href="route('bookings.instructor-bookings')" 
                                :active="request()->routeIs('bookings.instructor-bookings')">
                                حجوزاتي
                            </x-nav-link>

                        @else
                            <x-nav-link class="text-[#e29aa3] hover:text-[#f0c8cc]"
                                :href="route('bookings.my-bookings')" 
                                :active="request()->routeIs('bookings.my-bookings')">
                                حجوزاتي
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right -->
            <div class="hidden sm:flex items-center gap-4">
                @auth
                    <!-- User Dropdown -->
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm text-[#e29aa3] hover:text-[#f0c8cc]">
                                {{ Auth::user()->name }}
                                <svg class="ms-2 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                الملف الشخصي
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    تسجيل الخروج
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-[#e29aa3] hover:text-[#f0c8cc] text-sm">
                        تسجيل الدخول
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-white text-[#7a1f2b] px-4 py-1.5 rounded-md text-sm font-medium hover:bg-gray-100">
                        تسجيل جديد
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="text-[#e29aa3] focus:outline-none hover:text-[#f0c8cc]">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden bg-[#6a1b26]">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('bookings.my-bookings')" class="text-[#e29aa3]">
                    حجوزاتي
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')" class="text-[#e29aa3]">
                    الملف الشخصي
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-[#e29aa3]">
                        تسجيل الخروج
                    </x-responsive-nav-link>
                </form>
            @else
                <x-responsive-nav-link :href="route('login')" class="text-[#e29aa3]">
                    تسجيل الدخول
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" class="text-[#e29aa3]">
                    تسجيل جديد
                </x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>
