<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
//        User::create([
//            'name' => 'Admin User',
//            'email' => 'admin@mail.com',
//            'password' => Hash::make('password'), // use bcrypt or Hash::make
//        ]);
        User::query()->upsert([
            ['id'=>1,'name'=>'admin','email'=>'admin@mail.com','password'=>Hash::make('password')],
            ['id'=>2,'name'=>'salt lake','email'=>'house1@mail.com','password'=>Hash::make('password')],
        ], ['id']);

        $admin=User::query()->find(1);
        $admin->assignRole('Admin');

        $house=User::query()->find(2);
        $house->assignRole('House');
        $house->house_id = 1;
        $house->save();

    }
}
