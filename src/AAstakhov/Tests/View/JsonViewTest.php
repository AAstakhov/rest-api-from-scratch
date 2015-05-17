<?php

namespace AAstakhov\Tests\View;

use AAstakhov\View\JsonView;

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

    /**
     * @expectedException \AAstakhov\View\Exceptions\ViewException
     */
    public function testRenderWithWrongParameters()
    {
        $jsonView = new JsonView();
        $result = $jsonView->render([]);
    }
}
