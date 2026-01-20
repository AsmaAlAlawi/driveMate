<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'booking_id',
        'instructor_id',
        'student_id',
        'rating',
        'comment',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // تحديث تقييم المدرب تلقائياً
    protected static function booted()
    {
        static::created(function ($review) {
            $review->instructor->updateRating();
        });

        static::updated(function ($review) {
            $review->instructor->updateRating();
        });

        static::deleted(function ($review) {
            $review->instructor->updateRating();
        });
    }
}