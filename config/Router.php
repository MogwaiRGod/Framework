<?php

namespace config;

class Router {
    public function route($url) {
        // analyze URL to get path
        $path = parse_url($url, PHP_URL_PATH);

        // Divise path in segments
        $segments = explode('/', trim($path, '/'));

        // determine class and method to call
        $controller = (!empty($segments[0])) ? ucfirst($segments[0]) . 'Controller' : 'DefaultController';
        $action = (!empty($segments[1])) ? $segments[1] : 'index';

        // Include controller file
        $controllerFile = './Controllers/' . $controller . '.php';
        var_dump($controllerFile);

        // if the corresponding controller exists
        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            // Controller instanciation
            $controller = "Controllers\\" . $controller;
            $controllerInstance = new $controller();

            // check if method exists
            if (method_exists($controllerInstance, $action)) {
                // get all segments after the action in the url
                $params = array_slice($segments, 2);

                // call method with arguments
                call_user_func_array([$controllerInstance, $action], $params);
            } else {
                // Gérer l'action non trouvée
                echo 'Action not found';
            } // if else
        } else {
            // manage controller not found
            echo 'Controller not found';
        } // if else
    } // route
} // Router