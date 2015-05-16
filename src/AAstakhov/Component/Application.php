<?php

namespace AAstakhov\Component;

use AAstakhov\Interfaces\ApplicationInterface;

class Application implements ApplicationInterface
{
    protected $container;

    public function getContainer()
    {
        if ($this->container) {
            return $this->container;
        }

        $this->container = new Container();
        $this->container->add('router', function () {
            $router = new Router();
            $router->addRoute('/address', 'AAstakhov\Controller\AddressController', 'getAddress');

            return $router;
        });

        return $this->container;
    }
}