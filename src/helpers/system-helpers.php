<?php

if (!function_exists('env')) {
    function env(string $key)
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        return getenv($key);
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
