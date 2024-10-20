<?php

namespace CORE;

class Router
{
    public $routes = [];


    public function add($Method, $Uri, $Controller)
    {
        $this->routes[] = [
            'uri' => $Uri,  // Fixed: Keep URI as it is
            'method' => strtoupper($Method), // Ensure method is uppercase
            'controller' => $Controller,  // The controller function or name
            'middleware' => null
        ];
        return $this;
    }

    // Define GET request
    public function get($Uri, $Controller): static
    {
        return $this->add('GET', $Uri, $Controller); // Fixed: Pass Controller
    }

    // Define POST request
    public function post($Uri, $Controller): static
    {
        return $this->add('POST', $Uri, $Controller);
    }

    // Define DELETE request
    public function delete($Uri, $Controller): static
    {
        return $this->add('DELETE', $Uri, $Controller);
    }

    // Define PATCH request
    public function patch($Uri, $Controller): static
    {
        return $this->add('PATCH', $Uri, $Controller);
    }

    // Define PUT request
    public function put($Uri, $Controller): static
    {
        return $this->add('PUT', $Uri, $Controller);
    }

    // Apply middleware to the last defined route
    public function only($AUTH): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $AUTH;
        return $this;
    }

    // Route function to handle requests
    // Route function to handle requests
    public function route($Uri, $Method)
    {
        foreach ($this->routes as $route) {
            // Match both URI and request method
            if ($route['uri'] === $Uri && $route['method'] === strtoupper($Method)) {
                // Check if middleware exists
                if ($route['middleware']) {
                    Middleware::resolve($route['middleware']);
                }

                // Split controller and method (e.g., 'ProductsController@show')
                list($controller, $method) = array_pad(explode('@', $route['controller']), 2, 'index');

                // Include the controller file (assuming it's already autoloaded or required)
                try {
                    $controller = "Http\\Controller\\" . $controller; // Namespace adjustment
                    $instance = new $controller; // Instantiate the controller
                    return $instance->$method(); // Call the method
                } catch (\Error $e) {
                    echo "خطأ: " . $e->getMessage(); // طباعة أي استثناء
                    return $this->abort(); // قم بإرجاع صفحة 404
                }
            }
        }

        // If no match, return a 404 page
        return $this->abort();
    }

    // Abort function to handle 404 errors
    public function abort($CODE = 404)
    {
        http_response_code($CODE);
        return require BASEPATH('views/' . $CODE . '.php'); // Load 404 page
    }
}
