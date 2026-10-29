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
        Schema::table('procedimientos', function (Blueprint $table) {
            $table->unsignedBigInteger('especialidad_3_id')->nullable()->after('especialidad_2_id');
            $table->foreign('especialidad_3_id')->references('id')->on('especialidads')->onDelete('set null');
            $table->unsignedBigInteger('especialidad_4_id')->nullable()->after('especialidad_3_id');
            $table->foreign('especialidad_4_id')->references('id')->on('especialidads')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procedimientos', function (Blueprint $table) {
            $table->dropForeign(['especialidad_3_id', 'especialidad_4_id']);
            $table->dropColumn(['especialidad_3_id', 'especialidad_4_id']);
        });
    }
};
