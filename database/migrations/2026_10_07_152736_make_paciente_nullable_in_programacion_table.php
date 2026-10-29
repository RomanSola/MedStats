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
        Schema::table('programacion', function (Blueprint $table) {
            $table->string('paciente')->nullable()->change();
            $table->string('procedimiento')->nullable()->change();
            $table->string('cirujano')->nullable()->change();
            $table->boolean('es_reserva')->default(false)->after('suspendida');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programacion', function (Blueprint $table) {
            $table->string('paciente')->nullable(false)->change();
            $table->string('procedimiento')->nullable(false)->change();
            $table->string('cirujano')->nullable(false)->change();
            $table->dropColumn('es_reserva');
        });
    }
};
