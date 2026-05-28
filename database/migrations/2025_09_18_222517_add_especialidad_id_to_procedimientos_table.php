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
            //
            $table->unsignedBigInteger('especialidad_id')->nullable()->after('descripcion');
            $table->foreign('especialidad_id')->references('id')->on('especialidads')->onDelete('set null');
            $table->unsignedBigInteger('especialidad_2_id')->nullable()->after('especialidad_id');
            $table->foreign('especialidad_2_id')->references('id')->on('especialidads')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procedimientos', function (Blueprint $table) {
            //
            $table->dropForeign(['especialidad_id','especialidad_2_id']);
            $table->dropColumn(['especialidad_id','especialidad_2_id']);
        });
    }
};
