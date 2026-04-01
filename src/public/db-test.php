<?php
$host = 'db';
$user = 'sail';
$pass = 'password';
$db = 'raja_wisata';

echo "Testing connection to host: $host<br>";
try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    echo "Connection successful!<br>";
    
    $stmt = $pdo->query("SELECT VERSION()");
    $version = $stmt->fetchColumn();
    echo "MySQL Version: " . $version . "<br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "<br>";
    echo "Code: " . $e->getCode() . "<br>";
}

echo "<br>Environment Variables:<br>";
echo "DB_HOST: " . getenv('DB_HOST') . "<br>";
echo "DB_DATABASE: " . getenv('DB_DATABASE') . "<br>";
echo "APP_DEBUG: " . getenv('APP_DEBUG') . "<br>";
echo "APP_ENV: " . getenv('APP_ENV') . "<br>";
