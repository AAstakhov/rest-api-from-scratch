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
     * @param string $method GET|POST|PUT|DELETE
     * @param string $controllerServiceName
     * @param string $actionName
     * @return $this
     */
    public function addRoute($url, $method, $controllerServiceName, $actionName);

    /**
     * Gets route count
     *
     * @return integer
     */
    public function getRouteCount();

    /**
     * Executes controller action for the given request
     *
     * @param HttpRequestInterface $request
     * @return HttpResponseInterface
     */
    public function execute(HttpRequestInterface $request);
}