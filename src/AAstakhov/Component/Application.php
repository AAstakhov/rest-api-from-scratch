<?php

namespace AAstakhov\Component;

use AAstakhov\Interfaces\ApplicationInterface;

class Application implements ApplicationInterface
{
    public function getContainer()
    {
        $container = new Container();
        $container->add('router', function () {
            return new Router();
        });

        return $container;
    }
}