<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // أدمن
        User::create([
            'name' => 'المسؤول',
            'email' => 'admin@driving.om',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // متدرب تجريبي
        User::create([
            'name' => 'أحمد محمد',
            'email' => 'student@test.om',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // مدربين تجريبيين
        $instructorUsers = [
            ['name' => 'خالد العامري', 'email' => 'instructor1@test.om'],
            ['name' => 'سعيد البلوشي', 'email' => 'instructor2@test.om'],
            ['name' => 'محمد الحارثي', 'email' => 'instructor3@test.om'],
            ['name' => 'علي الشنفري', 'email' => 'instructor4@test.om'],
            ['name' => 'يوسف المعمري', 'email' => 'instructor5@test.om'],
        ];

        foreach ($instructorUsers as $instructorUser) {
            User::create([
                'name' => $instructorUser['name'],
                'email' => $instructorUser['email'],
                'password' => Hash::make('password'),
                'role' => 'instructor',
            ]);
        }
    }
}