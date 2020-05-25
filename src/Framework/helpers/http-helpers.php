<?php

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
    function request()
    {
        $request = new stdClass();
        foreach ($_REQUEST as $key => $value) {
            $request->$key = $value;
        }
        return $request;
    }
}

if (!function_exists('post')) {
    function post()
    {
        $post = new stdClass();
        foreach ($_POST as $key => $value) {
            $post->$key = $value;
        }
        return $post;
    }
}

if (!function_exists('get')) {
    function get()
    {
        $get = new stdClass();
        foreach ($_GET as $key => $value) {
            $get->$key = $value;
        }
        return $get;
    }
}