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
        Schema::table('historial_stocks', function (Blueprint $table) {
            //Claves foraneas
            $table->foreign('creado_por')->references('id')->on('users')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_stocks', function (Blueprint $table) {
            //
            $table->dropForeign('creado_por');
        });
    }
};
