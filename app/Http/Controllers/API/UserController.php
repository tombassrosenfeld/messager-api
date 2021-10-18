<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Http\Controllers\API\ChatController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    public function getUserChats(User $user)
    {   
        $chats = $user->chats;
        return ChatController::formatChats($chats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->all();
        // horrible insecure hack until Auth is implemented
        $data["password"] = "password";
        
        $user = User::create($data);

        $teamChat = Chat::all()->firstWhere('name', "Team Chat")->id;

        $user->chats()->attach($teamChat);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUserByEmail(Request $request)
    {   
        return User::all()->firstWhere('email', $request->email);
    }

    public function getRandomUsers()
    {
        return $users = User::all()->random(3)->all();
    }
}
