<?php

namespace Database\Seeders;

use App\Models\House;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::query()->upsert([
            [
                'id' => 1,
                'name' => 'GAD admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('password'),
                'mobile' => $this->generateMobile(),
            ]
        ], ['id']);

        User::query()->upsert([
            [
                'id' => 2,
                'name' => 'Msegs admin',
                'email' => 'msegs@mail.com',
                'password' => Hash::make('password'),
                'mobile' => $this->generateMobile(),
            ]
        ], ['id']);

        $admin = User::query()->find(1);
        $admin->assignRole('Admin');

        // Users for each house
        $houses = House::all();

        foreach ($houses as $house) {
            $username = strtolower(str_replace(' ', '_', $house->name));
            $email = $username . '@mail.com';

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $house->name,
                    'password' => Hash::make('password'),
                    'house_id' => $house->id,
                    'mobile' => $this->generateMobile(),
                ]
            );

            $user->assignRole('House');
        }
    }

    private function generateMobile(): string
    {
        return '9' . mt_rand(100000000, 999999999); // ensures a 10-digit mobile starting with 9
    }
}
