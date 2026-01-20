<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            
            $table->string('full_name');
            $table->string('phone');
            $table->decimal('hourly_rate', 8, 3); // السعر بالريال العماني
            $table->text('bio')->nullable(); // نبذة عن المدرب
            $table->string('license_number'); // رقم الرخصة
            $table->integer('years_experience')->default(0);
            $table->string('photo')->nullable();
            
            // حالة الحساب
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            
            // إحصائيات
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_bookings')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};