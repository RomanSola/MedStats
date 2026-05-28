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
        Schema::table('stocks', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('medicamento_id');
            $table->foreign('medicamento_id')
                ->references('id')
                ->on('medicamentos')
                ->onDelete('cascade');
            $table->dropColumn('nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign('medicamento_id');
            $table->dropColumn('medicamento_id');
            $table->string('nombre', 100);
        });
    }
};
