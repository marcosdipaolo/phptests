<?php

use App\Framework\Providers\AppServiceProvider;
use League\Container\Container;
use League\Container\ReflectionContainer;

if (!function_exists('env')) {
    function env(string $key)
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../php-tests/');
        $dotenv->load();
        return getenv($key);
    }
}

if (!function_exists('app')) {
    function app()
    {
        $app = new Container();
        $app->delegate(new ReflectionContainer);
        $app->addServiceProvider(AppServiceProvider::class);
        return $app;
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
