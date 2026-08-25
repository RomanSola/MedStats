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
            $table->boolean('suspendida')->default(false)->after('obito');
            $table->text('observacion_suspension')->nullable()->after('suspendida');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cirugias', function (Blueprint $table) {
            $table->dropColumn(['suspendida', 'observacion_suspension']);
        });
    }
};
