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
        Schema::table('usuario_perfils', function (Blueprint $table) {
            //
            $table->boolean('admin')->nullable()->after('perfil');
            $table->boolean('insumos')->nullable()->after('admin');
            $table->boolean('estadisticas')->nullable()->after('insumos');
            $table->boolean('pacientes')->nullable()->after('estadisticas');
            $table->boolean('camas')->nullable()->after('pacientes');
            $table->boolean('cirugias')->nullable()->after('camas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_perfils', function (Blueprint $table) {
            //
            $table->dropColumn('admin');
            $table->dropColumn('insumos');
            $table->dropColumn('estadisticas');
            $table->dropColumn('pacientes');
            $table->dropColumn('camas');
            $table->dropColumn('cirugias');
        });
    }
};
