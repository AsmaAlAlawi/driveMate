<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instructor_availabilities', function (Blueprint $table) {

            $table->id();
            $table->foreignId('instructor_id')->constrained()->onDelete('cascade');
            
            // أيام الأسبوع: 0 = الأحد، 6 = السبت
            $table->integer('day_of_week'); // 0-6
            $table->time('start_time'); // مثال: 08:00
            $table->time('end_time'); // مثال: 18:00
            
            $table->boolean('is_available')->default(true);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instructor_availability');
    }
};