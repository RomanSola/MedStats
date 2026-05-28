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
        Schema::table('procedimientos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_anestesia_id')->nullable();
    
            $table->foreign('tipo_anestesia_id')
                  ->references('id')
                  ->on('tipo_anestesias')
                  ->onDelete('restrict'); // evita que se borre si está en uso
        });
    }
    
    public function down()
    {
        Schema::table('procedimientos', function (Blueprint $table) {
            $table->dropForeign(['tipo_anestesia_id']);
            $table->dropColumn('tipo_anestesia_id');
        });
    }
};
