<?php
use App\Framework\Router;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$router = new Router();
require 'router.php';
$router->direct();
