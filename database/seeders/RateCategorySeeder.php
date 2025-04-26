<?php

namespace Database\Seeders;

use App\Models\RateCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RateCategory::insert([
            ['name' => 'FLAM/On Duty'],
            ['name' => 'Not on Duty'],
            ['name' => 'Referred Medical'],
            ['name' => 'Others'],
        ]);
    }
}
