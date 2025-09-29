<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomFeature extends Model
{
    protected $fillable = [
        'room_id',
        'nombre',
        'detalle',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
