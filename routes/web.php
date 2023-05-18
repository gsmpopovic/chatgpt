<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

/* Chat view for messenger */ 
Route::get('/chat', function () {
    return view('chat');
})->name('chat');

/* Returns the messenger chat view with dummy bot. */
Route::get('/sandbox', function () {
    
    $route = route('chat');

    return view('welcome')->with([
        'route' => "$route"
    ]);

})->name('sandbox');

/* Route at which bot is accessed. */
Route::post('/botman', [BotController::class, 'index']);

