<?php

use App\Http\Controllers;
use MDP\Framework\Providers\AppServiceProvider;
use Dotenv\Dotenv;
use MDP\Router\Router;

require __DIR__ . '/vendor/autoload.php';

define("STORAGE_PATH", env("STORAGE_PATH") ?? __DIR__ . "/storage");

try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $container = AppServiceProvider::registerContainer();

    $router = Router::create([
        Controllers\PageController::class,
        Controllers\AuthController::class,
        Controllers\UserController::class,
        Controllers\MailController::class,
    ], $container);
    $router->direct();
} catch (\Throwable $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $trace = $e->getTrace();
    return render("error.errors", compact('code', 'message', 'trace'));
}