<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $route = route('chat');

    return view('welcome')->with([
        'route' => "$route"
    ]);
});

Route::get('/chat', function () {
    return view('welcome');
})->name('chat');

Route::post('/botman', [BotController::class, 'index']);
