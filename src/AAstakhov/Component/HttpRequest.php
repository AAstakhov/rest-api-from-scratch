<?php

namespace AAstakhov\Component;

use AAstakhov\Interfaces\HttpRequestInterface;

class HttpRequest implements HttpRequestInterface
{
    /**
     * @var string
     */
    private $pathInfo;
    /**
     * @var string
     */
    private $method;
    /**
     * @var array
     */
    private $getVariables;
    /**
     * @var array
     */
    private $postVariables;


    /**
     * @param string $pathInfo
     * @param string $method
     * @param array $getVariables
     * @param array $postVariables
     */
    public function __construct($pathInfo, $method, array $getVariables, array $postVariables)
    {
        $this->pathInfo = $pathInfo;
        $this->method = $method;
        $this->getVariables = $getVariables;
        $this->postVariables = $postVariables;
    }

    public function getPathInfo()
    {
        return $this->pathInfo;
    }

    public function getMethod()
    {
        return $this->method;
    }


    public function getGetVariables()
    {
        return $this->getVariables;
    }

    public function getPostVariables()
    {
        return $this->postVariables;
    }
}