<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Johan', 'John', 'David', 'Michael', 'Sarah', 'Emily', 'Emma', 'Olivia'];

        for ($i = 0; $i < 50; $i++) {
            $randomName = $names[array_rand($names)];
            $randomString = Str::random(5); // Generate a random string for uniqueness

            User::insert([
                'name' => $randomName,
                'email' => strtolower($randomName) . '.' . $randomString . '@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'type' => 'suggestions',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
