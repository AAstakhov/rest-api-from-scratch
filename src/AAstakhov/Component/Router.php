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

    public function addRoute($url, $controllerServiceName, $actionName)
    {
        $this->routes[$url] = [
            'controller' => $controllerServiceName,
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

        // Get controller instance from the container
        $controllerServiceName = $this->routes[$url]['controller'];
        $controller = $this->container->get($controllerServiceName);

        // Execute a method of the controller with the suffix 'Action'
        $methodName = $this->routes[$url]['action'] . 'Action';
        $result = $controller->$methodName($parameters);

        return $result;
    }
}