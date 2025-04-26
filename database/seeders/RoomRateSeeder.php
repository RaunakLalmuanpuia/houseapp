<?php

namespace Database\Seeders;

use App\Models\RateCategory;
use App\Models\RoomRate;
use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $rateCategories = RateCategory::all();

        foreach (RoomType::all() as $roomType) {
            foreach ($rateCategories as $category) {
                RoomRate::create([
                    'room_type_id' => $roomType->id,
                    'rate_category_id' => $category->id,
                    'rate' => rand(1000, 5000), // Random rate for example
                ]);
            }
        }
    }
}
