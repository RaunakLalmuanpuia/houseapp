<?php

namespace Database\Seeders;

use App\Models\House;
use App\Models\State;
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
//        House::insert([
//            ['name' => 'Chanakyapuri'],
//            ['name' => 'Vasant Vihar'],
//            ['name' => 'Salt Lake'],
//            ['name' => 'New Town'],
//            ['name' => 'Mumbai'],
//            ['name' => 'Bengaluru'],
//            ['name' => 'Guwahati'],
//            ['name' => 'Shillong'],
//            ['name' => 'Silchar'],
//        ]);

        $states = State::pluck('id', 'name');

        House::insert([
            ['name' => 'Chanakyapuri', 'state_id' => $states['Delhi']],
            ['name' => 'Vasant Vihar', 'state_id' => $states['Delhi']],
            ['name' => 'Salt Lake', 'state_id' => $states['Kolkata']],
            ['name' => 'New Town', 'state_id' => $states['Kolkata']],
            ['name' => 'Mumbai', 'state_id' => $states['Mumbai']],
            ['name' => 'Bengaluru', 'state_id' => $states['Bengaluru']],
            ['name' => 'Shillong', 'state_id' => $states['Shillong']],
            ['name' => 'Guwahati', 'state_id' => $states['Assam']],
            ['name' => 'Silchar', 'state_id' => $states['Assam']],
        ]);

    }
}
