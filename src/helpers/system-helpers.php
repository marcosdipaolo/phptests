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
