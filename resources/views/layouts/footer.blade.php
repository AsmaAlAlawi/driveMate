<footer class="bg-[#7a1f2b] text-white mt-10">
    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <h4 class="font-bold text-lg mb-2">DriveMate</h4>
            <p class="text-[#ffd6d6]">أفضل منصة لحجز مدربي تعليم القيادة في سلطنة عمان.</p>
        </div>
        <div>
            <h4 class="font-bold text-lg mb-2">روابط مهمة</h4>
            <ul class="space-y-1">
                <li><a href="{{ route('home') }}" class="hover:text-[#ffd6d6]">الصفحة الرئيسية</a></li>
                <li><a href="{{ route('instructors.index') }}" class="hover:text-[#ffd6d6]">المدربين</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-[#ffd6d6]">من نحن</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-[#ffd6d6]">تواصل معنا</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold text-lg mb-2">تواصل معنا</h4>
            <p><i class="fas fa-phone me-2"></i> +968 1234 5678</p>
            <p><i class="fas fa-envelope me-2"></i> info@drivemate.com</p>
            <p><i class="fas fa-map-marker-alt me-2"></i> سلطنة عمان</p>
        </div>
    </div>
    <div class="border-t border-[#ffd6d6] text-center py-4 text-sm text-[#ffd6d6]">
        &copy; {{ date('Y') }} DriveMate. جميع الحقوق محفوظة.
    </div>
</footer>
