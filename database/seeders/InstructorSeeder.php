<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instructor;
use App\Models\User;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = [
            [
                'user_id' => 3, // خالد العامري
                'region_id' => 1, // مسقط
                'full_name' => 'خالد بن سالم العامري',
                'phone' => '98765432',
                'hourly_rate' => 10.000,
                'bio' => 'مدرب معتمد بخبرة 10 سنوات في تعليم القيادة. متخصص في تعليم المبتدئين.',
                'license_number' => 'OMN-123456',
                'years_experience' => 10,
                'status' => 'active',
                'average_rating' => 4.8,
                'total_reviews' => 45,
                'total_bookings' => 120,
            ],
            [
                'user_id' => 4, // سعيد البلوشي
                'region_id' => 1, // مسقط
                'full_name' => 'سعيد بن محمد البلوشي',
                'phone' => '97654321',
                'hourly_rate' => 12.000,
                'bio' => 'مدرب محترف مع خبرة واسعة في تدريب القيادة الدفاعية.',
                'license_number' => 'OMN-234567',
                'years_experience' => 8,
                'status' => 'active',
                'average_rating' => 4.9,
                'total_reviews' => 67,
                'total_bookings' => 150,
            ],
            [
                'user_id' => 5, // محمد الحارثي
                'region_id' => 2, // صلالة
                'full_name' => 'محمد بن علي الحارثي',
                'phone' => '96543210',
                'hourly_rate' => 9.500,
                'bio' => 'مدرب صبور ومتفاني في تعليم المبتدئين والمتقدمين.',
                'license_number' => 'OMN-345678',
                'years_experience' => 6,
                'status' => 'active',
                'average_rating' => 4.7,
                'total_reviews' => 32,
                'total_bookings' => 85,
            ],
            [
                'user_id' => 6, // علي الشنفري
                'region_id' => 3, // صحار
                'full_name' => 'علي بن أحمد الشنفري',
                'phone' => '95432109',
                'hourly_rate' => 11.000,
                'bio' => 'خبرة طويلة في تعليم القيادة على جميع أنواع المركبات.',
                'license_number' => 'OMN-456789',
                'years_experience' => 12,
                'status' => 'active',
                'average_rating' => 4.6,
                'total_reviews' => 28,
                'total_bookings' => 95,
            ],
            [
                'user_id' => 7, // يوسف المعمري
                'region_id' => 1, // مسقط
                'full_name' => 'يوسف بن خالد المعمري',
                'phone' => '94321098',
                'hourly_rate' => 8.500,
                'bio' => 'مدرب شاب ونشيط مع أسلوب تعليم عصري وفعال.',
                'license_number' => 'OMN-567890',
                'years_experience' => 4,
                'status' => 'active',
                'average_rating' => 4.5,
                'total_reviews' => 19,
                'total_bookings' => 48,
            ],
        ];

        foreach ($instructors as $instructor) {
            Instructor::create($instructor);
        }
    }
}