<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $fillable=['room_id', 'imagen', 'alt'];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
