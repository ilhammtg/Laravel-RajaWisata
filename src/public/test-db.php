<?php

$start = microtime(true);
try {
    $pdo = new PDO('mysql:host=db;dbname=raja_wisata', 'sail', 'password');
    echo "MySQL connection successful. Time taken: " . (microtime(true) - $start) . " seconds\n";
} catch (Exception $e) {
    echo "MySQL connection failed: " . $e->getMessage() . " Time taken: " . (microtime(true) - $start) . " seconds\n";
}

$start = microtime(true);
try {
    $redis = new Redis();
    $redis->connect('redis', 6379);
    echo "Redis connection successful. Time taken: " . (microtime(true) - $start) . " seconds\n";
} catch (Exception $e) {
    echo "Redis connection failed: " . $e->getMessage() . " Time taken: " . (microtime(true) - $start) . " seconds\n";
}
