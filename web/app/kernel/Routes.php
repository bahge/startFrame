<?php

namespace app\kernel;

use app\kernel\Request;
use app\kernel\Response;


class Routes {
    private $routes = [];

    public function __construct() {}

    public function on(string $method, string $route, $function): void {
        $params = explode('/', $route);
        $paramName = null;

        for ($i = 0; $i < count($params); $i++) {
            $routeArr = str_split($params[$i]);

            if ($routeArr[0] == ':') {
                $paramName = explode(':', $params[$i]);
                break;
            }
        }

        if (isset($paramName)) {
            array_push($this->routes, [
                "method" => $method,
                "function" => $function,
                "route" => $route,
            ]);

            return;
        }

        array_push($this->routes, [
            "method" => $method,
            "function" => $function,
            "route" => $route,
            "param" => $paramName,
        ]);
    }

    public function boot() {
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $RequestMethod = $_SERVER['REQUEST_METHOD'];

        $params = explode('/', $url);
        $paramName = null;

        foreach ($this->routes as $route) {
            if ($RequestMethod != $route['method']) {
                continue;
            }

            global $ok;

            $routeParams = explode('/', $route['route']);

            if (count($params) !== count($routeParams)) {
                continue;
            }

            $ok = true;
            $hasParam = false;

            foreach($routeParams as $key => $value) {
                if (isset($params[$key]) && $value !== $params[$key]) {
                    $separeted = explode(':', $value);

                    if (isset($separeted[1]) && isset($params[$key])) {
//                        var_dump($separeted); die;
                        global $hasParam, $paramName;

                        $hasParam = true;
                        $paramName = $separeted[1];

                        continue;
                    }

                    $ok = false;
                    break;
                }
            }

            if ($ok == true) {
                $req = new Request();
                $res = new Response();

                $route['function']($req);
                break;
            }
        }
    }
}
