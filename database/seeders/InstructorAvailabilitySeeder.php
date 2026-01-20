<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InstructorAvailability;

class InstructorAvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        // أوقات افتراضية لكل مدرب (من الأحد إلى الخميس)
        $instructorIds = [1, 2, 3, 4, 5];

        foreach ($instructorIds as $instructorId) {
            // من الأحد (0) إلى الخميس (4)
            for ($day = 0; $day <= 4; $day++) {
                InstructorAvailability::create([
                    'instructor_id' => $instructorId,
                    'day_of_week' => $day,
                    'start_time' => '08:00:00',
                    'end_time' => '18:00:00',
                    'is_available' => true,
                ]);
            }

            // السبت (6) - نصف دوام
            InstructorAvailability::create([
                'instructor_id' => $instructorId,
                'day_of_week' => 6,
                'start_time' => '08:00:00',
                'end_time' => '13:00:00',
                'is_available' => true,
            ]);
        }
    }
}