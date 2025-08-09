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
            $table->date('fecha_cirugia')->after('urgencia')->nullable();
            $table->time('hora_cirugia')->after('fecha_cirugia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            //
            $table->dropColumn('fecha_cirugia');
            $table->dropColumn('hora_cirugia');
        });
    }
};
