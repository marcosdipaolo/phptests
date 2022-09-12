<?php

use App\Framework\Providers\AppServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Level;
use MDP\Container\Container;

if (!function_exists('env')) {
    function env(string $key): bool|array|string
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../php-tests/');
        $dotenv->load();
        return getenv($key);
    }
}

if (!function_exists('app')) {
    function app(): Container
    {
        return AppServiceProvider::registerContainer();
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
        $log->pushHandler(new StreamHandler(__DIR__ . "/../logs/{$filename}.log", Level::Info));
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
        try {
            return render('error.errors', [
                'code' => 500,
                'message' => error_get_last()['message']
            ]);
        } catch(\Throwable $e) {
            //
        }
    }
    return null;
}


register_shutdown_function('on_shut_down');
