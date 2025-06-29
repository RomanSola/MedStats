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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->integer('dni')->unique();
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->date('fecha_nacimiento');
            $table->enum('genero', ['Masculino', 'Femenino']);
            $table->string('telefono', 20)->nullable();
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('provincia_id')->nullable();
            $table->unsignedBigInteger('cod_postal_id')->nullable();
            $table->text('direccion')->nullable();
            $table->unsignedBigInteger('creado_por');
            $table->unsignedBigInteger('modificado_por');
            $table->timestamps();
            //Claves foraneas
            $table->foreign('pais_id')->references('id')->on('pais')->onDelete('cascade');;
            $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');
            $table->foreign('cod_postal_id')->references('id')->on('codigo_postals')->onDelete('set null');
            //Agregar clave foranea a la tabla de usuarios
            //$table->foreign('creado_por')->references('id')->on('')->onDelete('set null');
            //$table->foreign('modificado_por')->references('id')->on('')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
