<?php

use App\Events\PrivateWebsocketTest;
use App\Events\PublicWebsocketTest;
use App\Events\WebsocketTest;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewChatController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomMessageController;
use App\Http\Controllers\UserController;
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
Route::get('/websocket-test', function() {
    // broadcast(new WebsocketTest('test'));
    broadcast(new PublicWebsocketTest());
    broadcast(new PrivateWebsocketTest());
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [ApplicationController::class, 'index'])->name('application');
    Route::get('/rooms/{room}/messages', [RoomMessageController::class, 'index'])->name('rooms.messages.index');
    Route::post('/rooms/{room}/messages', [RoomMessageController::class, 'store'])->name('rooms.messages.store');

    Route::get('/new-chat/get-users-by-email', [NewChatController::class, 'getUsersByEmail'])->name('new-chat.get-users-by-email');
});
