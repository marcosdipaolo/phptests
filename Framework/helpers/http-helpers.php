<?php

use MDP\Framework\Request;
use JetBrains\PhpStorm\NoReturn;

if (!function_exists('routeIs')) {
    /**
     * @param string $route
     * @return bool
     */
    function routeIs(string $route): bool
    {
        return '/' . $route === $_SERVER['REQUEST_URI'];
    }
}

if (!function_exists('request')) {
    function request(string $key = null)
    {
        $request = new Request;
        if ($key) {
            return $request->get($key);
        }
        return $request;
    }
}

if (!function_exists('post')) {
    function post(string $key = null): mixed
    {
        if ($key) {
            return $_POST[$key] ?? null;
        }
        return $_POST;
    }
}

if (!function_exists('files')) {
    function files(string $key = null): mixed
    {
        if ($key) {
            return $_FILES[$key] ?? null;
        }
        return $_FILES;
    }
}

if (!function_exists('get')) {
    function get(string $key = null): mixed
    {
        if ($key) {
            return $_GET[$key] ?? null;
        }
        return $_GET;
    }
}

if (!function_exists('baseUrl')) {
    function baseUrl(): bool|array|string
    {
        return env('BASE_URL');
    }
}

if (!function_exists('redirect')) {
    #[NoReturn] function redirect(string $uri, $data = []): void
    {
        setFlashMessages($data);
        header("Location: " . baseUrl() . $uri, true, 302);
        exit();
    }
}
if (!function_exists('getRealIpAddr')) {
    function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //check ip from share internet
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}

if (!function_exists('getControllers')) {
    function getControllers(string $namespace = "App\\Http\\Controllers\\"): array {
        $scan = scandir(ROOT_DIR . "/src/Http/Controllers");
        array_splice($scan, 0, 2);
        return array_map(function($class) use ($namespace) {
            $classNoExt = str_replace(".php", "", $class);
            return $namespace . $classNoExt;
        }, $scan);
    }
}
