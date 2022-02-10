<?php

namespace App\Core;

use Exception;

class Router
{
    /**
     * All registered routes.
     */
    public array $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Load a user's routes file.
     */
    public static function load(string $file): Router
    {
        $router = new static;

        require $file;

        return $router;
    }

    /**
     * Register a GET route.
     */
    public function get(string $uri, string $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Register a POST route.
     */
    public function post(string $uri, string $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Load the requested URI's associated controller method.
     */
    public function direct(string $uri, string $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        view('404');
    }

    /**
     * Load and call the relevant controller action.
     */
    protected function callAction(string $controller, string $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (! method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action();
    }
}
