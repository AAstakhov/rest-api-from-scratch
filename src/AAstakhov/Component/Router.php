<?php

namespace AAstakhov\Component;

use AAstakhov\Interfaces\ContainerInterface;
use AAstakhov\Interfaces\HttpRequestInterface;
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

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function addRoute($url, $method, $controllerServiceName, $actionName)
    {
        $this->routes[$url.$method] = [
            'controller' => $controllerServiceName,
            'action' => $actionName
        ];

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRouteCount()
    {
        return count($this->routes);
    }

    /**
     * @inheritdoc
     */
    public function execute(HttpRequestInterface $request)
    {
        $routeKey = $request->getPathInfo().$request->getMethod();

        if (!isset($this->routes[$routeKey])) {
            return null;
        }

        $route = $this->routes[$routeKey];

        // Get controller instance from the container
        $controllerServiceName = $route['controller'];
        $controller = $this->container->get($controllerServiceName);

        // Execute a method of the controller with the suffix 'Action'
        $methodName = $route['action'].'Action';
        $result = $controller->$methodName($request);

        return $result;
    }
}