<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Chat::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Chat::Create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  array $chats
     * @return array
     */
    public static function formatChats($chats)
    {   
        // sort chats by creation
        $chats = $chats->sortBy('created_at');
        
        // for each chat, take the last 20 messages
        $messages = $chats->flatMap(function ($chat) {
            return $chat->messages->sortBy('created_at')->take(20);
        });
       
        // return a nice 2D array of chats and their associated messages
        $response = [
            "chats" => $chats->all(),
            "messages" => $messages->all()
        ];

        return $response;
    }
}
