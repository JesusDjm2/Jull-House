<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $fillable = ['room_id', 'ota', 'url',];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
