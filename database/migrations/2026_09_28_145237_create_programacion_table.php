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
        Schema::create('programacion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('quirofano');
            $table->string('paciente');
            $table->string('especialidad');
            $table->string('procedimiento');
            $table->string('cirujano');
            $table->string('hora')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programacion');
    }
};
