<?php

namespace AAstakhov\Tests\Component;

use AAstakhov\Component\Application;
use AAstakhov\Component\Container;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testGetContainer()
    {
        $app = new Application();
        $container = $app->getContainer();
        $this->assertTrue($container instanceof Container);

    }
}
