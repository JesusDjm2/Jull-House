<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
        'nombre',
        'icono',
        'extra',
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withTimestamps();
    }
}
