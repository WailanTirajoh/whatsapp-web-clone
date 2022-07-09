<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NewChatController extends Controller
{
    public function getUsersByEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) abort(Response::HTTP_NOT_FOUND, "User for email $request->email not found on our system");
        if ($user->email == Auth::user()->email) abort(Response::HTTP_BAD_REQUEST, "Its you!");

        $authRooms = Auth::user()->rooms()->pluck('id')->toArray();
        $userRooms = $user->rooms()->pluck('id')->toArray();
        $intersect = array_intersect($authRooms, $userRooms);
        if (count($intersect) > 0) abort(Response::HTTP_BAD_REQUEST, "You already have chat with $user->name");

        // Create room for the user
        $room = Room::create([
            'type' => Room::TYPE_PERSONAL
        ]);
        $room->users()->attach(Auth::id(), ['join_at' => now()]);
        $room->users()->attach($user->id, ['join_at' => now()]);

        return response()->json([
            "message" => "User found, start chatting with him / her",
        ]);
    }
}
