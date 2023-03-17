<?php

//use App\Http\Controllers\ViewRoomController;
use App\Http\Controllers\Amyisme13\LaravelJitsi\Http\Controllers\ViewRoomController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::jitsi();

Route::get('/jitsi/{room}' , [ViewRoomController::class, '__invoke']);

