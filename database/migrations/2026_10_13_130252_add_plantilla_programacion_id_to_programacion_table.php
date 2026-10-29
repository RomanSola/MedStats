<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Agrega la columna plantilla_programacion_id para vincular cada programación
     * automática con la plantilla que la originó, permitiendo deduplicación precisa.
     */
    public function up(): void
    {
        Schema::table('programacion', function (Blueprint $table) {
            $table->unsignedBigInteger('plantilla_programacion_id')
                  ->nullable()
                  ->after('es_reserva')
                  ->comment('FK a la plantilla que generó esta programación automática (null = creada manualmente)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programacion', function (Blueprint $table) {
            $table->dropColumn('plantilla_programacion_id');
        });
    }
};
