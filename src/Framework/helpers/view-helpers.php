<?php

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
    /**
     * @param string $viewPath
     * @param array $data
     * @return mixed
     */
    function render(string $viewPath, array $data = [])
    {
        try {
            $path = str_replace('.', '/', $viewPath);
            $path =  __DIR__ . "/../../Views/{$path}.view.php";
            foreach($data as $key => $value) {
                $$key = $value;
            }
            return require $path;
        } catch (Throwable $e) {
            return (new App\Http\Controllers\PageController)->error($e->getCode(), $e->getMessage());
        }
    }
}

if (!function_exists("views_path")) {
    /**
     * @param string|null $path
     * @return string
     */
    function views_path(string $path = null)
    {
        $output = __DIR__ . '/Views';
        if ($path) {
            $output .= "/{$path}";
        }
        return $output;
    }
}