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
            //
            $table->unsignedBigInteger('quirofano_id')->nullable()->after('procedimiento_id');
            $table->unsignedBigInteger('ayudante_3_id')->nullable()->after('ayudante_2_id'); ;
            
            // Modificar columnas existentes para que acepten valores nulos
            $table->unsignedBigInteger('ayudante_1_id')->nullable()->change();
            $table->unsignedBigInteger('ayudante_2_id')->nullable()->change();
            
            $table->foreign('quirofano_id')
                ->references('id')
                ->on('quirofanos')
                ->onDelete('cascade');
            
            $table->foreign('ayudante_3_id')
                ->references('id')
                ->on('empleados')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cirugias', function (Blueprint $table) {
            //
            $table->dropForeign(['quirofano_id', 'ayudante_3_id']);
            $table->dropColumn(['quirofano_id', 'ayudante_3_id']);
            // Revertir columnas modificadas
            $table->unsignedBigInteger('ayudante_1_id')->nullable(false)->change();
            $table->unsignedBigInteger('ayudante_2_id')->nullable(false)->change();
        });
    }
};
