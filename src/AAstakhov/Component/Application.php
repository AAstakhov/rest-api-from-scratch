<?php

namespace AAstakhov\Component;

use AAstakhov\Interfaces\ApplicationInterface;

class Application implements ApplicationInterface
{
    public function getContainer()
    {
        $container = new Container();
        $container->add('router', function () {
            $router = new Router();
            $router->addRoute('/address', 'AAstakhov\Controller\AddressController', 'getAddress');

            return $router;
        });

        return $container;
    }
}