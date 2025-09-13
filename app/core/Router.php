<?php
class Router {
    private $routes = [];

    public function add($method, $path, $handler) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path'   => $path,
            'handler'=> $handler
        ];
    }

    public function dispatch($method, $uri) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                if (is_callable($route['handler'])) {
                    return call_user_func($route['handler']);
                }
                if (is_array($route['handler'])) {
                    [$controller, $action] = $route['handler'];
                    return call_user_func([new $controller, $action]);
                }
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
}
