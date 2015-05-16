<?php

namespace AAstakhov\Component;

class Application
{
    public function getContainer()
    {
        $container = new Container();

        return $container;
    }
}