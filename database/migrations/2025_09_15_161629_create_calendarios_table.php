<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calendarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->string('ota');           // airbnb, booking, system
            $table->text('url');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('calendarios');
    }
};
