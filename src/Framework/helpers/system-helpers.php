<?php

use App\Framework\Auth\Auth;
use App\Framework\Providers\AppServiceProvider;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

if (!function_exists('env')) {
    function env(string $key)
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../php-tests/');
        $dotenv->load();
        return getenv($key);
    }
}

if (!function_exists('app')) {
    function app(): Container
    {
        $app = new Container();
        $app->delegate(new ReflectionContainer);
        $app->addServiceProvider(AppServiceProvider::class);
        return $app;
    }
}

if (!function_exists('slug')) {
    function slug(string $text): string
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
          return 'n-a';
        }
        return $text;
      }
}

if (!function_exists('setUpLogger')) {
    function setUpLogger(string $name): Logger
    {
        $log = new Logger($name);
        $filename = slug($name);
        $log->pushHandler(new StreamHandler(__DIR__ . "/../logs/{$filename}.log", Logger::INFO));
        return $log;
    }
}

function on_shut_down()
{
    if (
        isset(error_get_last()['type']) &&
        isset(error_get_last()['message']) &&
        (error_get_last()['type'] == E_ERROR)
    ) {
        return render('error.errors', [
            'code' => 500,
            'message' => error_get_last()['message']
        ]);
    }
}


register_shutdown_function('on_shut_down');
