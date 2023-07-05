<?php

namespace Database\Seeders;

use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed requests with pending status for random users

        $users = User::all();

        foreach ($users as $user) {
            // Create 5 random pending requests for each user
            for ($i = 0; $i < 5; $i++) {
                Request::create([
                    'sender_id' => $user->id,
                    'receiver_id' => $this->getRandomReceiverId($user->id),
                    'status' => 'pending',
                ]);
            }
        }
    }

    private function getRandomReceiverId($excludeUserId)
    {
        // Get a random receiver user ID, excluding the provided user ID
        return User::where('id', '!=', $excludeUserId)->inRandomOrder()->value('id');
    }
}