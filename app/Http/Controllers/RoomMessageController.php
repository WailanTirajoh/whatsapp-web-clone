<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomMessageResource;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomMessageController extends Controller
{
    public function index(Room $room)
    {
        return response()->json([
            'messages' => RoomMessageResource::collection($room->messages()->with('user')->get())
        ]);
    }
}
