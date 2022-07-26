<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('private-channel', function ($user) {
    return true;
});

Broadcast::channel('room.message.{room_id}', function ($user, $room_id) {
    return in_array($room_id, $user->rooms->pluck('id')->toArray());
});

Broadcast::channel('user.{user_id}', function ($user, $user_id) {
    return (int) $user->id === (int) $user_id;
});
