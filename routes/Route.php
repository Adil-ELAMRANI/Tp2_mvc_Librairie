<?php

namespace App\Routes;

class Route {
    private static $routes = [];

    public static function get($url, $controller) {
        self::$routes[] = ['url' => BASE . $url, 'controller' => $controller, 'method' => 'GET'];
    }

    public static function post($url, $controller) {
        self::$routes[] = ['url' => BASE . $url, 'controller' => $controller, 'method' => 'POST'];
    }

    public static function dispatch() {
        session_start();
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $urlSegments = explode('?', $url);
        $urlPath = $urlSegments[0];

        foreach (self::$routes as $route) {
            if ($route['url'] == $urlPath && $route['method'] == $method) {
                $controllerSegments = explode('@', $route['controller']);
                $controllerName = "App\\Controllers\\" . $controllerSegments[0];
                $methodName = $controllerSegments[1];

                if (!class_exists($controllerName)) {
                    http_response_code(404);
                    die("404 - Contrôleur introuvable : $controllerName");
                }

                $controllerInstance = new $controllerName();

                if (!method_exists($controllerInstance, $methodName)) {
                    http_response_code(404);
                    die("404 - Méthode introuvable : $methodName");
                }

                if ($method == 'GET') {
                    if (isset($urlSegments[1])) {
                        parse_str($urlSegments[1], $queryParams);
                        $controllerInstance->$methodName($queryParams);
                    } else {
                        $controllerInstance->$methodName();
                    }
                } elseif ($method == 'POST') {
                    if (isset($urlSegments[1])) {
                        parse_str($urlSegments[1], $queryParams);
                        $controllerInstance->$methodName($_POST, $queryParams);
                    } else {
                        $controllerInstance->$methodName($_POST);
                    }
                }
                return;
            }
        }

        http_response_code(404);
        echo "404 - Page introuvable ! (Route non trouvée)";
    }
}
