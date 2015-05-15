<?php

namespace AAstakhov\Component;

use AAstakhov\Interfaces\RouterInterface;

class Router implements RouterInterface
{
    /**
     * @var array
     */
    private $routes = [];

    public function addRoute($url, $controllerClassName, $actionName)
    {
        $this->routes[$url] = [
            'controller' => $controllerClassName,
            'action' => $actionName
        ];
    }

    public function getRouteCount()
    {
        return count($this->routes);
    }

    public function execute($url, array $parameters)
    {
        if(!isset($this->routes[$url])) {
            return null;
        }

        // Instantiate controller instance by class name
        $controllerClassName = $this->routes[$url]['controller'];
        $controller = new $controllerClassName;

        // Execute a method of the controller with the suffix 'Action'
        $methodName = $this->routes[$url]['action'] . 'Action';
        $result = $controller->$methodName($parameters);

        return $result;
    }
}