<?php
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
            return require './src/Views/' . $path . '.view.php';
        } catch (Throwable $e) {
            return (new App\Controllers\PageController)->error($e->getCode(), $e->getMessage());
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