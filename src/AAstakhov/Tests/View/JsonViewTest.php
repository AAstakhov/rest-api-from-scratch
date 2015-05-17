<?php

namespace AAstakhov\Tests\View;

class JsonViewTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $jsonView = new JsonView();

        $parameters = [
            'record' => ['name' => 'Marcin', 'phone' => '502145785', 'street' => 'Opata Rybickiego 1']
        ];
        $result = $jsonView->render($parameters);
        $expected = '{"name":"Marcin","phone":"502145785","street":"Opata Rybickiego 1"}';

        $this->assertEquals($expected, $result);
    }
}
