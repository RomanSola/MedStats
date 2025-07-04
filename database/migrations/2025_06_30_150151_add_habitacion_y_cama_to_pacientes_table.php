<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('pacientes', function (Blueprint $table) {
        if (!Schema::hasColumn('pacientes', 'habitacion_id')) {
            $table->unsignedBigInteger('habitacion_id')->nullable()->after('id');
        }
        if (!Schema::hasColumn('pacientes', 'cama_id')) {
            $table->unsignedBigInteger('cama_id')->nullable()->after('habitacion_id');
        }
    });
}

public function down()
{
    Schema::table('pacientes', function (Blueprint $table) {
        $table->dropColumn(['habitacion_id', 'cama_id']);
    });
}
};
