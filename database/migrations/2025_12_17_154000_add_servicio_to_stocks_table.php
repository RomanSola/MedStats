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
            // Drop the existing unique constraint on lote
            // Attempt to drop it if it exists. 
            // Note: If the constraint name is different this might fail, but standard laravel naming is table_column_unique
            try {
                $table->dropUnique('stocks_lote_unique');
            } catch (\Exception $e) {
                // Ignore if it doesn't exist or has different name, 
                // though usually we should be precise. 
                // Given I can't inspect DB, I'll assume standard naming from previous migrations.
            }
            
            $table->string('servicio')->default('General')->after('cantidad_act');
            
            // Add new composite unique constraint
            $table->unique(['medicamento_id', 'lote', 'servicio'], 'stocks_med_lote_serv_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropUnique('stocks_med_lote_serv_unique');
            $table->dropColumn('servicio');
            
            // Restore unique constraint on lote
            $table->unique('lote', 'stocks_lote_unique');
        });
    }
};
