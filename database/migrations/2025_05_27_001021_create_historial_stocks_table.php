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
        Schema::create('historial_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_id')->constrained('stocks')->onDelete('cascade');
            $table->integer('cantidad'); // positivo: entrada, negativo: salida
            $table->date('fecha'); //Fecha de ingreso/egreso de stock
            $table->unsignedBigInteger('empleado_id')->nullable(); //Empleado que ingresa/extrae el medicamento
            $table->unsignedBigInteger('paciente_id')->nullable(); //para que paciente es el medicamento?
            $table->text('comentario')->nullable();
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->timestamps();
            //Claves foraneas
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            //FALTA TABLA USUARIOS
            //$table->foreign('creado_por')->references('id')->on('usuarios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_stocks');
    }
};
