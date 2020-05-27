<?php

use App\Framework\Request;

if (!function_exists('routeIs')) {
    /**
     * @param string $route
     * @return bool
     */
    function routeIs(string $route)
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
    function post(string $key = null)
    {
        if ($key) {
            return isset($_POST[$key]) ? $_POST[$key] : null;
        }
        return $_POST;
    }
}

if (!function_exists('get')) {
    function get(string $key = null)
    {
        if ($key) {
            return isset($_GET[$key]) ? $_GET[$key] : null;
        }
        return $_GET;
    }
}

if (!function_exists('baseUrl')) {
    function baseUrl()
    {
        return env('BASE_URL');
    }
}

if (!function_exists('redirect')) {
    function redirect(string $uri, $data = [])
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
