<?php

namespace App\Http\Controllers;

use App\Events\ReceiveMessageEvent;
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
        DB::beginTransaction();
        foreach ($room->messages()->where('sender_id', '!=', Auth::id())->with('reads')->get() as $message) {
            if (!in_array(Auth::id(), $message->reads->pluck('user_id')->toArray())) {
                $message->reads()->create([
                    'user_id' => Auth::id(),
                    'read_at' => now()
                ]);
            }
        }
        DB::commit();
        return response()->json([
            'messages' => RoomMessageResource::collection($room->messages()->with([
                'user',
                'reads' => [
                    'user'
                ]
            ])->get())
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

            foreach ($room->users as $user) {
                broadcast(new ReceiveMessageEvent($room, $user));
            }

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
