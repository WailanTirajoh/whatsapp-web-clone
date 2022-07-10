<?php

namespace App\Http\Controllers;

use App\Events\StoreRoomMessageEvent;
use App\Http\Requests\StoreRoomMessageRequest;
use App\Http\Resources\RoomMessageResource;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class RoomMessageController extends Controller
{
    public function index(Room $room)
    {
        return response()->json([
            'messages' => RoomMessageResource::collection($room->messages()->with('user')->get())
        ]);
    }

    public function store(Room $room, StoreRoomMessageRequest $request)
    {
        try {
            DB::beginTransaction();

            $message = Message::create([
                'sender_id' => Auth::id(),
                'room_id' => $room->id,
                'message' => $request->message,
            ]);
            broadcast(new StoreRoomMessageEvent($message))->toOthers();

            DB::commit();

            return response()->json([
                "message" => "message send successfully",
                "data" => [
                    "message" => RoomMessageResource::make($message)
                ]
            ]);
        } catch (Throwable $e) {
            DB::rollBack();

            return response()->json([
                "message" => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
