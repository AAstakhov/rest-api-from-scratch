<?php

namespace AAstakhov\Interfaces;

/**
 * Router interface
 */
interface RouterInterface
{
    /**
     * Adds new route
     *
     * @param string $url
     * @param string $controllerClassName
     * @param string $actionName
     * @return void
     */
    public function addRoute($url, $controllerClassName, $actionName);

    /**
     * Gets route count
     *
     * @return integer
     */
    public function getRouteCount();

    /**
     * Executes controller action for the given url
     *
     * @param string $url
     * @param array $parameters
     * @return mixed
     */
    public function execute($url, array $parameters);
}