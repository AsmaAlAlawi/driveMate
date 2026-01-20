<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained()->onDelete('cascade');
            
            // معلومات الحجز
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration_hours')->default(1); // عدد الساعات
            
            $table->decimal('total_price', 8, 3);
            
            // الحالة
            $table->enum('status', [
                'pending',      // في انتظار الدفع
                'confirmed',    // تم الدفع
                'completed',    // مكتمل
                'cancelled'     // ملغي
            ])->default('pending');
            
            $table->text('student_notes')->nullable();
            $table->text('instructor_notes')->nullable();
            
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};