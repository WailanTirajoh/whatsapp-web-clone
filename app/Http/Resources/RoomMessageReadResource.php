<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomMessageReadResource extends JsonResource
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
            "id" => $this->id,
            "message_id" => $this->message_id,
            "user_id" => $this->user_id,
            "read_at" => $this->read_at,
            "user" => RoomMessageReadUserResource::make($this->user)
        ];
    }
}
