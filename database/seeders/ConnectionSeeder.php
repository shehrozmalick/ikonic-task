<?php

namespace Database\Seeders;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed connections for random users

        $users = User::all();

        foreach ($users as $user) {
            // Create 3 random connections for each user
            for ($i = 0; $i < 3; $i++) {
                Connection::create([
                    'user_id' => $user->id,
                    'connected_user_id' => $this->getRandomConnectionId($user->id),
                ]);
            }
        }
    }

    private function getRandomConnectionId($excludeUserId)
    {
        // Get a random connection user ID, excluding the provided user ID
        return User::where('id', '!=', $excludeUserId)->inRandomOrder()->value('id');
    }
}
