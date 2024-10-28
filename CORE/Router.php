<?php

namespace CORE;

use CORE\ValidationException;

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
     * @throws ValidationException
     */
    public function route($requestUri, $requestMethod) {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $requestUri && $route['method'] === $requestMethod) {
                $controller = $route['controller'];

                if (is_callable($controller)) {
                    return $controller();
                } else {
                    list($controllerName, $method) = explode('@', $controller);
                    return $this->callController($controllerName, $method);
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
        throw new ValidationException("No route found for $requestUri with method $requestMethod.");
    }

    protected function callController($controllerName, $method)
    {
        $controller = new $controllerName;
        $controller->$method();
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        require BASE_PATH . "views/{$code}.php";
        die();
    }
}
