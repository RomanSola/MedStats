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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('lote', 50)->unique();
            $table->date('fecha_vencimiento');
            $table->integer('cantidad_act');
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('modificado_por')->nullable();
            $table->timestamps();
            /*Claves foraneas
            $table->foreign('creado_por')->references('id')->on('usuarios')->onDelete('set null');
            $table->foreign('modificado_por')->references('id')->on('usuarios')->onDelete('set null');
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
