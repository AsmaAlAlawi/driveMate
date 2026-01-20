<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'user_id',
        'region_id',
        'full_name',
        'phone',
        'hourly_rate',
        'bio',
        'license_number',
        'years_experience',
        'photo',
        'status',
        'average_rating',
        'total_reviews',
        'total_bookings',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:3',
        'average_rating' => 'decimal:2',
    ];

    // العلاقات
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function availability()
    {
        return $this->hasMany(InstructorAvailability::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // دالة للتحقق من التوفر في وقت معين
    public function isAvailableAt($date, $startTime, $endTime)
    {
        $dayOfWeek = date('w', strtotime($date));
        
        // تحقق من الأوقات المتاحة
        $hasAvailability = $this->availability()
            ->where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->where('start_time', '<=', $startTime)
            ->where('end_time', '>=', $endTime)
            ->exists();
        
        if (!$hasAvailability) {
            return false;
        }
        
        // تحقق من عدم وجود حجوزات متضاربة
        $hasConflict = $this->bookings()
            ->where('booking_date', $date)
            ->whereIn('status', ['confirmed', 'pending'])
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                      });
            })
            ->exists();
        
        return !$hasConflict;
    }

    // تحديث معدل التقييم
    public function updateRating()
    {
        $this->average_rating = $this->reviews()->avg('rating') ?? 0;
        $this->total_reviews = $this->reviews()->count();
        $this->save();
    }
}