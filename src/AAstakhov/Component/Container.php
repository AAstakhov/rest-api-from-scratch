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

    public function add($serviceName, Closure $service)
    {
        $this->services[$serviceName] = $service;
    }

    public function get($serviceName)
    {
        if (!isset($this->services[$serviceName])) {
            throw new ServiceNotFoundException($serviceName);
        }

        $closure = $this->services[$serviceName];

        return $closure();
    }
}