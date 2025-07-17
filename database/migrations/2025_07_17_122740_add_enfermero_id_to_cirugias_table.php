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
        $table->unsignedBigInteger('enfermero_id')->nullable()->after('instrumentador_id');
        $table->foreign('enfermero_id')->references('id')->on('empleados')->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cirugias', function (Blueprint $table) {
        $table->dropForeign(['enfermero_id']);
        $table->dropColumn('enfermero_id');
    });
    }
};
