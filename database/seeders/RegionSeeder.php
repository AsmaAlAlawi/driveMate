<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            ['name' => 'مسقط', 'name_en' => 'Muscat'],
            ['name' => 'صلالة', 'name_en' => 'Salalah'],
            ['name' => 'صحار', 'name_en' => 'Sohar'],
            ['name' => 'نزوى', 'name_en' => 'Nizwa'],
            ['name' => 'صور', 'name_en' => 'Sur'],
            ['name' => 'البريمي', 'name_en' => 'Al Buraimi'],
            ['name' => 'الرستاق', 'name_en' => 'Rustaq'],
            ['name' => 'عبري', 'name_en' => 'Ibri'],
        ];

        DB::table('regions')->insert($regions);
    }
}