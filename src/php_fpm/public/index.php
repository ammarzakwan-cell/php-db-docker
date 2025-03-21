<?php
declare(strict_types=1);

use App\Models\User;

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

$users = User::get();

dd($users);