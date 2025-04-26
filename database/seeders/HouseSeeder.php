<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        House::insert([
            ['name' => 'Chanakyapuri'],
            ['name' => 'Vasant Vihar'],
            ['name' => 'Salt Lake'],
            ['name' => 'New Town'],
            ['name' => 'Mumbai'],
            ['name' => 'Bengaluru'],
            ['name' => 'Guwahati'],
            ['name' => 'Shillong'],
            ['name' => 'Silchar'],
        ]);
    }
}
