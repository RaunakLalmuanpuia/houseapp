<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\House;
class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        State::insert([
            ['name' => 'Delhi'],
            ['name' => 'Kolkata'],
            ['name' => 'Mumbai'],
            ['name' => 'Bengaluru'],
            ['name' => 'Shillong'],
            ['name' => 'Assam'],
        ]);
    }
}
