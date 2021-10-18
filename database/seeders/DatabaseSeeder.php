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
        $newUsers = User::factory(10)->create();

        // if this is not the first round of seeding, don't create the team chat again
        $teamChat = Chat::firstOrCreate([
            'name' => 'Team Chat'
        ]);

        // if this is not the first round of seeding, only attach the new users
        $teamChat->users()->attach($newUsers->pluck('id')->all());

        Chat::factory(20)->create();

        // Populate the pivot table
        $users = User::all();

        Chat::all()->each(function ($chat) use ($users) { 
            $chat->users()->attach(
                $users->random(rand(2, 5))->pluck('id')->toArray()
            ); 
        });

        Message::factory(300)->create();

    }
}
