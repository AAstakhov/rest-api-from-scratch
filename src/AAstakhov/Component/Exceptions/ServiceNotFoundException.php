<?php

namespace AAstakhov\Component\Exceptions;


use Exception;

class ServiceNotFoundException extends Exception
{

    /**
     * @var string
     */
    private $serviceName;

    /**
     * @param string $serviceName
     * @param Exception $previous
     */
    public function __construct($serviceName, Exception $previous = null)
    {
        $this->serviceName = $serviceName;
        parent::__construct(sprintf('Service %s is not registered in the container.', $serviceName), 0, $previous);
    }

}