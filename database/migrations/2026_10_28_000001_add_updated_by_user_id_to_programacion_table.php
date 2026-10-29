<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programacion', function (Blueprint $table) {
            $table->foreignId('updated_by_user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete()
                  ->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('programacion', function (Blueprint $table) {
            $table->dropForeign(['updated_by_user_id']);
            $table->dropColumn('updated_by_user_id');
        });
    }
};
