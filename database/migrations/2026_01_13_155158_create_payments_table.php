<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            
            $table->decimal('amount', 8, 3);
            $table->string('payment_method')->default('thawani'); // ثواني
            
            // معلومات الدفع من ثواني
            $table->string('session_id')->nullable();
            $table->string('payment_reference')->nullable();
            
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};