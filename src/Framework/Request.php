<?php

namespace App\Framework;

class Request
{
    public function get(string $key)
    {
        return $this->has($key) ? $_REQUEST[$key] : null;
    }

    public function has(string $key)
    {
        return isset($_REQUEST[$key]);
    }

    public function all()
    {
        return $_REQUEST;
    }
}
