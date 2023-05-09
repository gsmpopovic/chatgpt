<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

use Orhanerday\OpenAi\OpenAi;

class BotController extends Controller
{
    //


    public function chat($question){

        $open_ai_key = getenv('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);

        $complete = $open_ai->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "system",
                    "content" => "You are a helpful assistant."
                ],
                [
                    "role" => "user",
                    "content" => "Who won the world series in 2020?"
                ],
                [
                    "role" => "assistant",
                    "content" => "The Los Angeles Dodgers won the World Series in 2020."
                ],
                [
                    "role" => "user",
                    "content" => "Where was it played?"
                ],
            ],
            'temperature' => 1.0,
            'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
         ]);

         // decode response
        $d = json_decode($complete);

        // Get Content
        
        error_log($complete);
        //return $d->choices[0]->message->content;

    }

    public function index(){

        $config = [
            // Your driver-specific configuration
            // "telegram" => [
            //    "token" => "TOKEN"
            // ]
        ];
        
        // Load the driver(s) you want to use
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
        
        // Create an instance
        $botman = BotManFactory::create($config);
        
        // Give the bot something to listen for.
        try {

            $botman->hears("{question}", function (BotMan $bot, $question) {
                $test = "ok";
                $content = $this->chat($question);
                $bot->reply($content);
            });
        
        } catch (\Exception $e){

            // catch error 

        }
        
        // Start listening
        $botman->listen(); 
    }

}
