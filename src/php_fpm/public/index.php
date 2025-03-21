<?php
declare(strict_types=1);


define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/vendor/autoload.php';

try {
    $dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
    $dotenv->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    error_log($e->getMessage());
}

require_once ROOT_PATH . '/database/db.php';

date_default_timezone_set('Asia/Kuala_lumpur');

session_start();

try {
    $pdo = new PDO(
        "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};port={$_ENV['DB_PORT']}",
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    // Query users
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll();

    dd($users);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}