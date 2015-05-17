<?php

namespace AAstakhov\Tests\Component;

use AAstakhov\Component\HttpRequest;

class HttpRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $request = new HttpRequest('/test', 'PUT', ['id' => 10], ['x' => 'y']);

        $this->assertEquals('/test', $request->getPathInfo());
        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals(['id' => 10], $request->getGetVariables());
        $this->assertEquals(['x' => 'y'], $request->getPostVariables());
    }
}
