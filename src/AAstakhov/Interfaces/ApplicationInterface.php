<?php

namespace AAstakhov\Interfaces;

interface ApplicationInterface
{
    /**
     * Gets container
     *
     * @return ContainerInterface
     */
    public function getContainer();

    /**
     * Creates request from global server variables ($_SERVER, $_GET, $_POST etc)
     *
     * @return HttpRequestInterface
     */
    public function createRequestFromGlobals();
}