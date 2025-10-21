<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('devices', function (Blueprint $table) {
        $table->id();
        $table->enum('tipo', ['tablet', 'telefono']);
        $table->string('marca');
        $table->string('modelo');
        $table->string('numero_serie')->unique();
        $table->string('imei')->unique()->nullable();
        $table->enum('estado', ['disponible', 'asignado', 'en_reparacion'])->default('disponible');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
