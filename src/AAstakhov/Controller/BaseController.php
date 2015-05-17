<?php

namespace AAstakhov\Controller;

use AAstakhov\Interfaces\ContainerInterface;
use AAstakhov\Interfaces\HttpResponseInterface;

/**
 * Base controller
 */
abstract class BaseController
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var HttpResponseInterface
     */
    private $response;


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return HttpResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param HttpResponseInterface $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
}