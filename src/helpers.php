<?php

if (!function_exists('dd')) {
    function dd()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
        die();
    }
}

if (!function_exists('d')) {
    function d()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
    }
}

if (!function_exists("views_path")) {
    function views_path(string $path = null)
    {
        $output = __DIR__ . '/Views';
        if ($path) {
            $output .= "/{$path}";
        }
        return $output;
    }
}

if (!function_exists("asset")) {
    function asset(string $path = null)
    {
        $output = 'http://' . $_SERVER['HTTP_HOST'] . '/dist';
        if ($path) {
            $output .= "/{$path}";
        }
        return $output;
    }
}

if (!function_exists('render')) {
    function render(string $viewPath, array $data = [])
    {
        try {
            $path = str_replace('.', '/', $viewPath);
            foreach ($data as $key => $value) {
                $$key = $value;
            }
            return require './src/Views/' . $path . '.view.php';
        } catch (Throwable $e) {
            return (new App\Controllers\PageController)->error($e->getCode(), $e->getMessage());
        }
    }
}

function on_shut_down()
{
    if (error_get_last()['type'] == E_ERROR) {
        return render('error.errors', [
            'code' => 500,
            'message' => error_get_last()['message']
        ]);
    }
}

register_shutdown_function('on_shut_down');
