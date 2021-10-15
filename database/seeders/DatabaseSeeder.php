<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chat;
use App\Models\Message;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Chat::factory(20)->create();

        // Populate the pivot table
        $users = User::all();

        Chat::all()->each(function ($chat) use ($users) { 
            $chat->users()->attach(
                $users->random(rand(2, 5))->pluck('id')->toArray()
            ); 
        });

        Message::factory(200)->create();

    }
}
