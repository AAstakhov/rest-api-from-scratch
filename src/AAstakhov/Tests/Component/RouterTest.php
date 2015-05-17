<?php

namespace AAstakhov\Tests\Component;

use AAstakhov\Component\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testAddRoute()
    {
        $container = $this->getMock('AAstakhov\Interfaces\ContainerInterface');

        $router = new Router($container);
        $router->addRoute('/test_url', 'GET', 'controller.test', 'test');
        $this->assertEquals(1, $router->getRouteCount());
    }

    public function testExecute()
    {
        $container = $this->getMock('AAstakhov\Interfaces\ContainerInterface');
        $container
            ->expects($this->once())
            ->method('get')
            ->willReturn(new TestController());

        $router = new Router($container);
        $router->addRoute('/test_url', 'GET', 'controller.test', 'test');

        $response = $router->execute('/test_url', 'GET', ['id' => 10]);

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