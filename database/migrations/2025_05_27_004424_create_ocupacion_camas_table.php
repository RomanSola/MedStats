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
        Schema::create('ocupacion_camas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cama_id')->constrained('camas')->onDelete('cascade');
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->dateTime('fecha_ingreso');
            $table->dateTime('fecha_egreso')->nullable(); //Opcional por si el paciente todavia no se ha dado de alta
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocupacion_camas');
    }
};
