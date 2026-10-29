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
        Schema::create('plantilla_programaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('dia_semana'); // 1 = Lunes, 2 = Martes, ..., 7 = Domingo
            $table->string('quirofano');
            $table->string('hora')->nullable();
            $table->string('especialidad');
            $table->string('procedimiento')->nullable();
            $table->string('cirujano')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_programaciones');
    }
};
