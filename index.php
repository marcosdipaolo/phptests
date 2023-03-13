<?php

use MDP\Framework\Providers\AppServiceProvider;
use Dotenv\Dotenv;
use MDP\Router\Router;
use MDP\Router\RouterConfiguration;

require __DIR__ . '/vendor/autoload.php';

try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $config = new RouterConfiguration();
    $config->setControllersNamespace('App\Http\Controllers');
    $config->setRoutesFilePath(__DIR__ . '/src/Http/router.php');

    $container = AppServiceProvider::registerContainer();

    $router = Router::create($config, $container);
    $router->direct();
} catch (\Throwable $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $trace = $e->getTrace();
    return render("error.errors", compact('code', 'message', 'trace'));
}