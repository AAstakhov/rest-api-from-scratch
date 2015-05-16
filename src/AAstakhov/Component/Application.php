<?php

namespace AAstakhov\Component;

use AAstakhov\Controller\AddressController;
use AAstakhov\Interfaces\ApplicationInterface;
use AAstakhov\Interfaces\ContainerInterface;

class Application implements ApplicationInterface
{
    protected $container;

    public function getContainer()
    {
        if ($this->container) {
            return $this->container;
        }

        $this->container = $this->buildContainer();;

        return $this->container;
    }

    /**
     * @return ContainerInterface
     */
    protected function buildContainer()
    {
        $container = new Container();

        // Register Address controller
        $container->add('controller.address', function () use ($container) {
            return new AddressController($container);
        });

        // Register Router
        $container->add('router', function () use ($container) {
            $router = new Router($container);
            $router->addRoute('/address', 'controller.address', 'getAddress');

            return $router;
        });

        return $container;
    }
}