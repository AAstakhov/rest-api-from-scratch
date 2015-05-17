<?php

namespace AAstakhov\Component;

use AAstakhov\Interfaces\ContainerInterface;
use AAstakhov\Interfaces\RouterInterface;

class Router implements RouterInterface
{
    /**
     * @var array
     */
    private $routes = [];
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function addRoute($url, $method, $controllerServiceName, $actionName)
    {
        $this->routes[$url.$method] = [
            'controller' => $controllerServiceName,
            'action' => $actionName
        ];

        return $this;
    }

    public function getRouteCount()
    {
        return count($this->routes);
    }

    public function execute($url, $method, array $parameters)
    {
        if (!isset($this->routes[$url.$method])) {
            return null;
        }

        $route = $this->routes[$url.$method];

        // Get controller instance from the container
        $controllerServiceName = $route['controller'];
        $controller = $this->container->get($controllerServiceName);

        // Execute a method of the controller with the suffix 'Action'
        $methodName = $route['action'].'Action';
        $result = $controller->$methodName($parameters);

        return $result;
    }
}