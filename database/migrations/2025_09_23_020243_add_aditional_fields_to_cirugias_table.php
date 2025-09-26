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
        Schema::table('cirugias', function (Blueprint $table) {
            //Campos adicionales
            $table->unsignedBigInteger('especialidad_id')->nullable()->after('paciente_id');
            $table->unsignedBigInteger('enfermero_2_id')->nullable()->after('enfermero_id');
            $table->unsignedBigInteger('tipo_anestesia_2_id')->nullable()->after('tipo_anestesia_id');
            $table->unsignedBigInteger('instrumentador_2_id')->nullable()->after('instrumentador_id');
            $table->unsignedBigInteger('procedimiento_2_id')->nullable()->after('procedimiento_id');
            $table->boolean('obito')->nullable()->after('urgencia');
            $table->time('duracion')->nullable()->after('obito');
            //Claves foraneas
            $table->foreign('especialidad_id')->references('id')->on('especialidads')->onDelete('set null');
            $table->foreign('enfermero_2_id')->references('id')->on('empleados')->onDelete('set null');
            $table->foreign('tipo_anestesia_2_id')->references('id')->on('tipo_anestesias')->onDelete('set null');
            $table->foreign('instrumentador_2_id')->references('id')->on('empleados')->onDelete('set null');
            $table->foreign('procedimiento_2_id')->references('id')->on('procedimientos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cirugias', function (Blueprint $table) {
            //Claves foraneas
            $table->dropForeign(['especialidad_id',
                                'enfermero_2_id', 
                                'tipo_anestesia_2_id',
                                'instrumentador_2_id',
                                'procedimiento_2_id' ]);
            //Columnas de la tabla
            $table->dropColumn(['especialidad_id',
                                'enfermero_2_id',
                                'tipo_anestesia_2_id',
                                'instrumentador_2_id',
                                'procedimiento_2_id',
                                'obito',
                                'duracion' ]);
        });
    }
};
