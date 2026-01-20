<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'student_id',
        'amount',
        'payment_method',
        'session_id',
        'payment_reference',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:3',
        'paid_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}