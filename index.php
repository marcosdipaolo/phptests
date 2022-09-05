<?php

use App\Framework\Providers\AppServiceProvider;
use Dotenv\Dotenv;
use MDP\Router\Router;
use MDP\Router\RouterConfiguration;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = new RouterConfiguration();
$config->setControllersNamespace('App\Http\Controllers');
$config->setRoutesFilePath(__DIR__ . '/src/Http/router.php');

$container = AppServiceProvider::registerContainer();

try {
    $router = Router::create($config, $container);
    $router->direct();
} catch(\Throwable $e){
    render('error.errors', ['code' => 500, 'message' => $e->getMessage()]);
}