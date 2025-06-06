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
        Schema::create('cirugias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('procedimiento_id');
            $table->unsignedBigInteger('cirujano_id');
            $table->unsignedBigInteger('ayudante_1_id');
            $table->unsignedBigInteger('ayudante_2_id');
            $table->unsignedBigInteger('anestesista_id');
            $table->unsignedBigInteger('tipo_anestesia_id');
            $table->unsignedBigInteger('instrumentador_id');
            $table->boolean('urgencia');
            $table->unsignedBigInteger('creado_por');
            $table->unsignedBigInteger('modificado_por');
            $table->timestamps();
            //Claves foraneas
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('procedimiento_id')->references('id')->on('procedimientos')->onDelete('cascade');
            $table->foreign('cirujano_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('ayudante_1_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('ayudante_2_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('anestesista_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('tipo_anestesia_id')->references('id')->on('tipo_anestesias')->onDelete('cascade');
            $table->foreign('instrumentador_id')->references('id')->on('empleados')->onDelete('cascade');
            //FALTA LA TABLA DE USUARIOS
            //$table->foreign('creado_por')->references('id')->on('usuarios');
            //$table->foreign('modificado_por')->references('id')->on('usuarios');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cirugias');
    }
};
