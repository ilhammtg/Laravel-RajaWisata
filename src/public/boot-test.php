<?php

$start = microtime(true);
require __DIR__.'/../vendor/autoload.php';
$autoLoadTime = microtime(true) - $start;
echo "Autoload: " . $autoLoadTime . " seconds\n";

$start = microtime(true);
$app = require_once __DIR__.'/../bootstrap/app.php';
echo "Bootstrap APP: " . (microtime(true) - $start) . " seconds\n";

$start = microtime(true);
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
echo "Make Kernel: " . (microtime(true) - $start) . " seconds\n";

$start = microtime(true);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);
echo "Handle Request: " . (microtime(true) - $start) . " seconds\n";
