<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');               // Nombre de la habitación
            $table->string('tipo')->nullable();               // Tipo (suite, doble, single...)
            $table->decimal('precio', 10, 2);// Precio por noche
            $table->unsignedInteger('capacidad');      
            $table->text('descripcion')->nullable();   
            $table->string('ical_url')->nullable(); 
            $table->text('mapa')->nullable();       
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
