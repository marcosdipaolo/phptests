<?php

use JetBrains\PhpStorm\NoReturn;

if (!function_exists('dd')) {
    #[NoReturn] function dd(): void
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
        die();
    }
}

if (!function_exists('d')) {
    function d(): void
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
    }
}