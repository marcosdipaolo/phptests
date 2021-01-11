<?php
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = new MDP\Router\RouterConfiguration();
$config->setControllersNamespace('App\Http\Controllers');
$config->setRoutesFilePath(__DIR__ . '/src/Http/router.php');
try {
    $router = MDP\Router\Router::create($config);
    $router->direct();
} catch(\Throwable $e){
    render('error.errors', ['code' => 500, 'message' => $e->getMessage()]);
}