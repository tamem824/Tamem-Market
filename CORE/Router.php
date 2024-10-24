<?php

namespace CORE;

use CORE\Exception;
use Http\Controller\HomeController;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                if (!empty($route['middleware'])) {
                    Middleware::resolve($route['middleware']);
                }

                [$controller, $method] = explode('@', $route['controller']);
                $controller = 'Http\\Controller\\' . $controller;

                if (class_exists($controller)) {
                    $controllerInstance = new $controller;

                    if (method_exists($controllerInstance, $method)) {
                        return call_user_func([$controllerInstance, $method]);
                    } else {
                        throw new Exception("Method $method not found in controller $controller.");
                    }
                } else {
                    throw new Exception("Controller $controller not found.");
                }
            }
        }

        throw new Exception("No route found for $uri with method $method.");
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    protected function abort($code = 404)
    {
        http_response_code($code);

        require BASEPATH("views/{$code}.php");

        die();
    }
}
