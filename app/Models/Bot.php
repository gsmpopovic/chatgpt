<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Bot extends Model
{
    use HasFactory;

    public $fillable = [
        "chat_server",
        "iframe_endpoint",
        "time_format",
        "datetime_format",
        "title",
        "intro_message",
        "display_message_time",
        "placeholder_text",
        "main_color",
        "bubble_avatar_url",
        "desktop_height",
        "desktop_width",
        "mobile_height",
        "mobile_width",
        "video_height",
        "about_link",
        "user_id",

        "model",
        "temperature",
        "max_tokens",
        "frequency_penalty",
        "presence_penalty"


    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
