<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['nombre', 'tipo', 'precio', 'capacidad', 'descripcion'];

    public function calendars()
    {
        return $this->hasMany(Calendario::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function images()
    {
        return $this->hasMany(Galeria::class);
    }
    public function features()
    {
        return $this->hasMany(RoomFeature::class);
    }
}
