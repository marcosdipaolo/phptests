<?php

use Dotenv\Dotenv;
use MDP\Container\Exceptions\ContainerException;
use MDP\Container\Exceptions\NotFoundException;
use MDP\Framework\Providers\AppServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Level;
use MDP\Container\Container;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

if (!function_exists('env')) {
    function env(string $key, string $default = NULL): bool|array|string|null
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        return match ($_ENV[$key]) {
            "", null => $default,
            default => $_ENV[$key],
        };
    }
}

if (!function_exists('app')) {
    /**
     * @throws NotFoundExceptionInterface
     * @throws NotFoundException
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     * @throws ContainerException
     */
    function app(string $identifier = null): mixed
    {
        $container = AppServiceProvider::registerContainer();
        if($identifier) {
            return $container->get($identifier);
        }
        return $container;
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

if (!function_exists('onShutDown')) {
    function onShutDown()
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
    register_shutdown_function('onShutDown');
}
