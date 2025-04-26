<?php

namespace Database\Seeders;

use App\Models\House;
use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roomTypesPerHouse = [
            'Salt Lake' => ['VIP Suite/Room', 'A.C. Deluxe','Normal A.C. Room', '5-bedded A.C. Room'],
            'Chanakyapuri' => ['VIP Suite/Room', 'A.C. Deluxe','Normal A.C. Room', '5-bedded A.C. Room'],
            'Vasant Vihar' => ['VIP Suite/Room', 'A.C. Deluxe','Normal A.C. Room', '5-bedded A.C. Room'],
            'New Town' => ['VIP Suite/Room', 'A.C. Deluxe','Normal A.C. Room', '5-bedded A.C. Room'],
            'Mumbai' => ['VIP Suite/Room', 'A.C. Deluxe','Normal A.C. Room', '5-bedded A.C. Room'],
            'Bengaluru' => ['VIP Suite/Room', 'A.C. Deluxe','Normal A.C. Room', '5-bedded A.C. Room'],
            'Guwahati' => ['VIP Suite/Room', 'A.C. Deluxe','Normal A.C. Room', '5-bedded A.C. Room'],
            'Shillong' => ['VIP Suite/Room', 'A.C. Deluxe','Normal A.C. Room', '5-bedded A.C. Room'],
            'Silchar' => ['VIP Suite/Room', 'A.C. Deluxe','Normal A.C. Room', '5-bedded A.C. Room'],
        ];

        foreach ($roomTypesPerHouse as $houseName => $roomTypes) {
            $house = House::where('name', $houseName)->first();
            foreach ($roomTypes as $type) {
                RoomType::create([
                    'house_id' => $house->id,
                    'name' => $type,
                ]);
            }
        }
    }
}
