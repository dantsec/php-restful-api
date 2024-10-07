<?php

namespace RestfulAPI\Core;

use RestfulAPI\Utils\HttpResponseHandler;

class Core
{
    /**
     * Run the router to match the URL to the appropriate controller action.
     *
     * @param array $routes An associative array of routes where keys are URL patterns
     *                      and values are arrays mapping HTTP methods to controller actions.
     * @return void
     */
    public static function run(array $routes): void
    {
        $url = '/';

        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        if ($url !== '/') {
            $url = rtrim($url, '/');
        }

        $routerFound = false;

        foreach($routes as $path => $controller) {
            // TODO: "Universalize" {id}
            $pattern = '#^' . preg_replace('/{id}/', '(\w+)', $path) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routerFound = true;

                if (!isset($controller[$_SERVER['REQUEST_METHOD']])) {
                    HttpResponseHandler::sendResponse(405, 'Method not allowed.');
                }

                [$currentController, $action] = explode('@', $controller[$_SERVER['REQUEST_METHOD']]);

                $controller = new ("RestfulAPI\\Controllers\\$currentController");

                $controller->$action($matches);
            }
        }

        if (!$routerFound) {
            HttpResponseHandler::sendResponse(404, 'Not found.');
        }
    }
}
