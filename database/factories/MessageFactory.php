<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Message;
use App\Models\Chat;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // choose a random chat to belong to
        $chat = Chat::all()->random();
        // choose a random user from thqt chat to belong to
        $user = $chat->users->random();

        return [
            'content' => $this->faker->sentence(),
            'chat_id' => $chat->id,
            'user_id' => $user->id
        ];
    }
}
