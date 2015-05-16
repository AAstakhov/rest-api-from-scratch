<?php

namespace AAstakhov\Interfaces;

use AAstakhov\Component\Exceptions\ServiceNotFoundException;
use Closure;

/**
 * Service container interface
 */
interface ContainerInterface
{
    /**
     * Adds service to the service container
     *
     * @param string $serviceName
     * @param callable $service
     * @return void
     */
    public function add($serviceName, Closure $service);

    /**
     * Gets service by name
     *
     * @param string $serviceName
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function get($serviceName);
}