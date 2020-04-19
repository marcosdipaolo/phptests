<?php

namespace App\Models;

use App\Controllers\PageController;

class Router
{
    /** @var array $get */
    public $get = [];
    /** @var array $post */
    public $post = [];
    /** @var array $put */
    public $put = [];
    /** @var array $patch */
    public $patch = [];
    /** @var array $delete */
    public $delete = [];

    /**
     * @param $uri
     * @param $action
     */
    public function get(string $uri, $action): void
    {
        $this->get[$uri] = $action;
    }

    /**
     * @param $uri
     * @param $action
     */
    public function post(string $uri, $action): void
    {
        $this->post[$uri] = $action;
    }

    /**
     * @param $uri
     * @param $action
     */
    public function put(string $uri, $action): void
    {
        $this->put[$uri] = $action;
    }

    /**
     * @param $uri
     * @param $action
     */
    public function patch(string $uri, $action): void
    {
        $this->patch[$uri] = $action;
    }

    /**
     * @param $uri
     * @param $action
     */
    public function delete(string $uri, $action): void
    {
        $this->delete[$uri] = $action;
    }

    /**
     * @return mixed|string
     */
    public function direct()
    {
        try {
            // figure out route and method
            $route = explode('?', $_SERVER['REQUEST_URI'])[0];
            $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
            $action = $this->$requestMethod[$route];
            // check if route exists and if not send 404 page
            if ($this->routeDoesntExist($route, $requestMethod)) {
                return (new PageController())->error(404, 'Page not found');
            }
            if($action instanceof \Closure) {
                return $action();
            }
            // redirect to controller method
            $controller = $this->resolveController($route);
            $controllerMethod = $this->resolveMethod($route);
            return (new $controller)->$controllerMethod();
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $route
     * @param $requestMethod
     * @return bool
     */
    private function routeDoesntExist(string $route, $requestMethod)
    {
        return !in_array($route, array_keys($this->$requestMethod));
    }

    /**
     * @param $route
     * @return string
     */
    private function resolveController($route): string
    {
        return '\\App\\Controllers\\' . explode('@', $this->get[$route])[0];
    }

    /**
     * @param $route
     * @return string
     */
    private function resolveMethod($route): string
    {
        return explode('@', $this->get[$route])[1];
    }
}