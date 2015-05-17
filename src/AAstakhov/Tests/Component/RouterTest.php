<?php

namespace AAstakhov\Tests\Component;

use AAstakhov\Component\HttpRequest;
use AAstakhov\Component\Router;
use AAstakhov\Interfaces\HttpRequestInterface;

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

        $request = new HttpRequest('/test_url', 'GET', ['id' => 10], []);
        $response = $router->execute($request);

        $this->assertEquals('Response is 10', $response);
    }

}


class TestController
{
    public function testAction(HttpRequestInterface $request)
    {
        $parameters = $request->getGetVariables();
        return 'Response is ' . $parameters['id'];
    }
}