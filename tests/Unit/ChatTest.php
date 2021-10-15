<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Chat;
use App\Models\User;


class ChatTest extends TestCase
{
    /**
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_add_chat()
    {
        User::create([
            "name" => "Testy Testerson",
            "email" => "testy@mctest.face",
            "password" => "password"
        ]);
        
        Chat::create([
            "name" => "Test Chat",
        ]);
            
        $userFromDB = User::first();
        $chatFromDB = Chat::first();

        
        $this->assertSame("Test Chat", $chatFromDB->name);
        
        //check that relationship is being set up correctly
        $chatFromDB->users()->attach($userFromDB->id);
        
        $this->assertSame($chatFromDB->users->first()->id, User::first()->id);
    }

}
