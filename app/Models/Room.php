<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'horary',
        'is_active'
    ];

    public function reservations()
    {
        return $this->hasMany(RoomUser::class);
    }
}
