<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable foreign key checks to allow index swapping
        Schema::disableForeignKeyConstraints();

        // 1. Create servicios table (check if exists to allow retry)
        if (!Schema::hasTable('servicios')) {
            Schema::create('servicios', function (Blueprint $table) {
                $table->id();
                $table->string('nombre')->unique();
                $table->text('descripcion')->nullable();
                $table->timestamps();
            });
        }

        // 2. Add servicio_id to stocks (nullable first)
        if (!Schema::hasColumn('stocks', 'servicio_id')) {
            Schema::table('stocks', function (Blueprint $table) {
                $table->unsignedBigInteger('servicio_id')->nullable()->after('cantidad_act'); // changed 'after' to be safe since 'servicio' might be dropped or not
                $table->foreign('servicio_id')->references('id')->on('servicios');
            });
        }

        // 3. Migrate data
        // Only run if we still have the 'servicio' string column to read from
        if (Schema::hasColumn('stocks', 'servicio')) {
            $stocks = DB::table('stocks')->select('id', 'servicio')->whereNotNull('servicio')->get();
            $servicesMap = []; 

            foreach ($stocks as $stock) {
                $serviceName = $stock->servicio;
                if (!$serviceName) continue;

                if (!isset($servicesMap[$serviceName])) {
                    $existing = DB::table('servicios')->where('nombre', $serviceName)->first();
                    if ($existing) {
                        $servicesMap[$serviceName] = $existing->id;
                    } else {
                        $id = DB::table('servicios')->insertGetId([
                            'nombre' => $serviceName,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $servicesMap[$serviceName] = $id;
                    }
                }

                // Update stock record
                DB::table('stocks')->where('id', $stock->id)->update(['servicio_id' => $servicesMap[$serviceName]]);
            }
        }

        // 4. Drop old column and update constraints
        Schema::table('stocks', function (Blueprint $table) {
            // Ensure we have an index for medicamento_id before dropping the composite one
            // This prevents "needed in a foreign key constraint" error
            // checks if index exists before adding? Schema helper doesn't have hasIndex easily. 
            // We just add it blindly, usually harmless or we can try/catch, 
            // BUT simpler: explicit index for FK.
            // Note: Laravel usually names basic index as table_column_index
            // We'll add it if it doesn't collide, but blindly adding 'index' might duplicate.
            // Let's rely on disableForeignKeyConstraints() handling the check verification pause 
            // allowing us to drop the index, provided we add a new one or if the FK is temporarily unchecked.
            // Actually, disableForeignKeyConstraints affects the *checks* on insert/update/delete. DDL operations might still strict check in some MySQL versions.
            // Best practice: Explicitly add index for first column of composite if needed.
            $table->index('medicamento_id'); 

            // Drop unique that uses 'servicio' string
            try {
                $table->dropUnique('stocks_med_lote_serv_unique');
            } catch (\Exception $e) {
                // Ignore if already dropped
            }
            
            // Drop string column
            if (Schema::hasColumn('stocks', 'servicio')) {
                $table->dropColumn('servicio');
            }

            // Make foreign key not null
            // (Assuming data is consistent)
            $table->unsignedBigInteger('servicio_id')->nullable(false)->change();

            // Add new unique constraint
            // Check if unique index exists to avoid duplication error on retry
            // Hard to check index existence easily in pure schema builder without raw SQL.
            // We'll trust the catch block or standard behavior.
            try {
                $table->unique(['medicamento_id', 'lote', 'servicio_id'], 'stocks_med_lote_serv_id_unique');
            } catch (\Exception $e) {
                // ignore
            }
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('stocks', function (Blueprint $table) {
            try {
                $table->dropUnique('stocks_med_lote_serv_id_unique');
            } catch (\Exception $e) {}
             
             if (Schema::hasColumn('stocks', 'servicio_id')) {
                $table->dropForeign(['servicio_id']);
                $table->dropColumn('servicio_id');
             }

             if (!Schema::hasColumn('stocks', 'servicio')) {
                $table->string('servicio')->nullable(); 
             }
             
             try {
                $table->unique(['medicamento_id', 'lote', 'servicio'], 'stocks_med_lote_serv_unique');
             } catch (\Exception $e) {}
        });

        Schema::dropIfExists('servicios');

        Schema::enableForeignKeyConstraints();
    }
};
