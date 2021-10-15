<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ["content"];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function chat()
    {
        $this->belongsTo(Chat::class);
    }
}