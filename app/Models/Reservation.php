<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable=['room_id','ota', 'external_id', 'fecha_inicio', 'fecha_final', 'resumen'];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
