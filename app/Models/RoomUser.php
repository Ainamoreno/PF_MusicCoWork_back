<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'cancelled',
        'date',
    ];

    public function room()
    {
        return $this->belongsToMany(Room::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
