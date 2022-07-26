<?php

namespace App\Events;

use App\Http\Resources\AuthUserRoomsResource;
use App\Http\Resources\RoomMessageResource;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ReceiveMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $room;
    private $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Room $room, User $user)
    {
        $this->room = $room;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("user." . $this->user->id);
    }

    public function broadcastAs()
    {
        return 'receive-message';
    }

    /**
     * send data to be broadcasted with
     */
    public function broadcastWith()
    {
        return [
            "room" => AuthUserRoomsResource::make($this->room)
        ];
    }
}
