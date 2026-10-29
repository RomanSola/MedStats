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
            $table->boolean('realizada')->default(false)->nullable()->after('observaciones');
            $table->boolean('suspendida')->default(false)->nullable()->after('realizada');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programacion', function (Blueprint $table) {
            $table->dropColumn(['realizada', 'suspendida']);
        });
    }
};
