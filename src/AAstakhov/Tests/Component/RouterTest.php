<?php

namespace AAstakhov\Tests\Component;

use AAstakhov\Component\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testAddRoute()
    {
        $router = new Router();
        $router->addRoute('/test_url', 'AAstakhov\Tests\Component\TestController', 'test');
        $this->assertEquals(1, $router->getRouteCount());
    }

    public function testExecute()
    {
        $router = new Router();
        $router->addRoute('/test_url', 'AAstakhov\Tests\Component\TestController', 'test');

        $response = $router->execute('/test_url', ['id' => 10]);

        $this->assertEquals('Response is 10', $response);
    }

}


class TestController
{
    public function testAction($parameters)
    {
        return 'Response is ' . $parameters['id'];
    }
}