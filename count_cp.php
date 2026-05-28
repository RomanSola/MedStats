<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
$count = DB::table('codigo_postals')->count();
echo "Total CP: " . $count . "\n";

$sample = DB::table('codigo_postals')->limit(5)->get();
print_r($sample->toArray());
