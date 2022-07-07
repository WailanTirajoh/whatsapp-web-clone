<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Room extends Model
{
    use HasFactory;

    const TYPE_PERSONAL = 1;
    const TYPE_GROUP    = 2;

    protected $fillable = [
        'type'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('join_at');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function typeString(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->type == self::TYPE_PERSONAL ? 'personal' : 'group'
        );
    }

    public function profilePicture(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->type == self::TYPE_PERSONAL) {
                    $user = $this->users()->where('id', '<>', Auth::id())->first();
                    return $user->profile_photo_url;
                }
            }
        );
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->type == self::TYPE_PERSONAL) {
                    $user = $this->users()->where('id', '<>', Auth::id())->first();
                    return $user->name;
                }
            }
        );
    }

    public function lastMessage(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->messages()->orderByDesc('created_at')->first();
            }
        );
    }
}
