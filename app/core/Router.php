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
                    $controllerInstance = new $controller();

                    if (in_array($method, ['POST', 'PUT'])) {
                        $data = json_decode(file_get_contents("php://input"), true);
                        return call_user_func([$controllerInstance, $action], $data);
                    }

                    return call_user_func([$controllerInstance, $action]);
                }
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
}
