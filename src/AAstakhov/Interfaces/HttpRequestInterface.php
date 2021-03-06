<?php

namespace AAstakhov\Interfaces;

interface HttpRequestInterface
{
    /**
     * Gets path information
     *
     * @return string
     */
    public function getPathInfo();

    /**
     * Gets request method
     *  - GET
     *  - POST
     *  - PUT
     *  - DELETE
     *
     * @return string
     */
    public function getMethod();

    /**
     * Gets GET variables
     *
     * @return array
     */
    public function getGetVariables();

    /**
     * Gets POST variables
     *
     * @return array
     */
    public function getPostVariables();
}