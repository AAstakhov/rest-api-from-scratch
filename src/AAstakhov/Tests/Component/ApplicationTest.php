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

    public function createRequestFromGlobals()
    {
        $app = new Application();

        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $_SERVER['PATH_INFO'] = '/test';
        $_GET = ['get1' => 1, 'get2' => 2];
        $_POST = ['post1' => 1, 'post2' => 2];

        $request = $app->createRequestFromGlobals();

        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('/test', $request->getPathInfo());
        $this->assertEquals(['get1' => 1, 'get2' => 2], $request->getGetVariables());
        $this->assertEquals(['post1' => 1, 'post2' => 2], $request->getPostVariables());
    }
}
