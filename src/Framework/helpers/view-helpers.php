<?php

use App\Http\Controllers\PageController;

if (!function_exists("asset")) {
    function asset(string $path = null): string
    {
        $output = 'http://' . $_SERVER['HTTP_HOST'] . '/dist';
        if ($path) {
            $output .= "/{$path}";
        }
        return $output;
    }
}

if (!function_exists('setFlashMessages')) {
    function setFlashMessages(array $data): void
    {
        $types = ['danger' => '<strong>Oh Snap!! </strong>', 'success' => '<strong>Success!! </strong>'];
        foreach ($types as $type => $heading) {
            if (isset($data[$type])) {
                session()->put($type, $heading .    $data[$type]);
            }
        }
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
            setFlashMessages($data);
            $path = str_replace('.', '/', $viewPath);
            $path =  __DIR__ . "/../../Views/{$path}.view.php";
            foreach ($data as $key => $value) {
                $$key = $value;
            }
            return require $path;
        } catch (Throwable $e) {
            return app()
                ->get(PageController::class)
                ->error($e->getCode(), $e->getMessage());
        }
    }
}

if (!function_exists("views_path")) {
    /**
     * @param string|null $path
     * @return string
     */
    function views_path(string $path = null): string
    {
        $output = __DIR__ . '/Views';
        if ($path) {
            $output .= "/{$path}";
        }
        return $output;
    }
}

if (!function_exists('clearFlashMessages')) {
    function clearFlashMessages(): void
    {
        $types = ['success', 'info', 'warning', 'danger', 'secondary', 'primary'];
        foreach ($types as $type) {
            session()->forget($type);
        }
    }
}
