<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /* 
        Web widget options
        https://botman.io/2.0/web-widget
        */
        Schema::create('bots', function (Blueprint $table) {
            $table->id();
            $table->string("chat_server");
            $table->string("iframe_endpoint");
            $table->string("time_format");
            $table->string("datetime_format");
            $table->string("title");
            $table->string("intro_message");
            $table->string("display_message_time");
            $table->string("placeholder_text");
            $table->string("main_color");
            $table->string("bubble_avatar_url");
            $table->string("desktop_height");
            $table->string("desktop_width");
            $table->string("mobile_height");
            $table->string("mobile_width");
            $table->string("video_height");
            $table->string("about_link");
            $table->string("about_text");
            $table->string("model");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('model');
            $table->string('temperature');
            $table->string('max_tokens');
            $table->string('frequency_penalty');
            $table->string('presence_penalty');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bots');
    }
};
