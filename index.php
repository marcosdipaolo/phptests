<?php

use Dotenv\Dotenv;
use MDP\Framework\Providers\AppServiceProvider;
use MDP\Router\Router;

require __DIR__ . '/vendor/autoload.php';

define("START", intval(microtime(true) * 1000));
$performanceLogger = setUpLogger("performance");
$performanceLogger->info("START: " . intval((microtime(true) * 1000) - START));

$performanceLogger->info("After loading autoload: " . intval((microtime(true) * 1000) - START));

const ROOT_DIR = __DIR__;

define("STORAGE_PATH", env("STORAGE_PATH") ?? __DIR__ . "/storage");

try {

    $performanceLogger->info("Before dotenv: " . intval((microtime(true) * 1000) - START));
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $performanceLogger->info("After dotenv and before container: " . intval((microtime(true) * 1000) - START));
    $container = AppServiceProvider::registerContainer();
    $performanceLogger->info("After container and before Router: " . intval((microtime(true) * 1000) - START));
    $router = Router::create(getControllers(), $container);
    $router->direct();
    $performanceLogger->info("After Router: " . intval((microtime(true) * 1000) - START));
} catch (\Throwable $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $trace = $e->getTrace();
    return render("error.errors", compact('code', 'message', 'trace'));
}
