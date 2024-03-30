<?php

use Dotenv\Dotenv;
use MDP\Framework\Providers\AppServiceProvider;
use MDP\Router\Router;

require __DIR__ . '/vendor/autoload.php';

const ROOT_DIR = __DIR__;

define("STORAGE_PATH", env("STORAGE_PATH", "/storage"));

try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $container = AppServiceProvider::registerContainer();
    $router = Router::create(getControllers(), $container);
    $router->direct();
} catch (\Throwable $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $trace = $e->getTrace();
    return render("error.errors", compact('code', 'message', 'trace'));
}
