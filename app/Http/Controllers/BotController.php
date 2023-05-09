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

    public $open_ai = null; 

    public function __construct(){

        $open_ai_key = getenv('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);
        $this->open_ai = $open_ai; 

    }

    public function chat($question){


        $config = config("chat.config");

        array_push($config['messages'], [
            "role" => "user",
            "content" => $question
        ]); 

        $complete = $this->open_ai->chat($config);

         // decode response
        $d = json_decode($complete);

        // Get Content
        
        error_log($complete);

        $content = $d->choices[0]->message->content;

        return $content;

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
                $content = $this->chat($question);
                $bot->typesAndWaits(2);
                $bot->reply($content);
            });
        
        } catch (\Exception $e){

            error_log($e->getMessage());
            
            // catch error 

        }
        
        // Start listening
        $botman->listen(); 
    }

}
