<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserRoomsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->typeString,
            'profile_picture' => $this->profilePicture,
            'name' => $this->name,
            'last_message' => AuthUserRoomLastMessageResource::make($this->lastMessage),
            'users' => AuthUserRoomUsersResource::collection($this->users)
        ];
    }
}
