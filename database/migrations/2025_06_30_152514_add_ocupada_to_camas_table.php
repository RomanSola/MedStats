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
    Schema::table('camas', function (Blueprint $table) {
        $table->boolean('ocupada')->default(false)->after('codigo');
    });
}

public function down()
{
    Schema::table('camas', function (Blueprint $table) {
        $table->dropColumn('ocupada');
    });
}
};
