<?php
use App\Http\Router;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();
$router->loadRoutes();
$router->direct();
