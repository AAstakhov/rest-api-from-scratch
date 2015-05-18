<?php

namespace AAstakhov\Component;

use AAstakhov\Component\Exceptions\ServiceNotFoundException;
use AAstakhov\Interfaces\ContainerInterface;
use Closure;

class Container implements ContainerInterface
{
    /**
     * @var array
     */
    protected $services = [];

    /**
     * @inheritdoc
     */
    public function add($serviceName, Closure $service)
    {
        $this->services[$serviceName] = $service;
    }

    /**
     * @inheritdoc
     */
    public function get($serviceName)
    {
        if (!isset($this->services[$serviceName])) {
            throw new ServiceNotFoundException($serviceName);
        }

        $closure = $this->services[$serviceName];

        return $closure();
    }
}