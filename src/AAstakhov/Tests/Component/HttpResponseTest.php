<?php

namespace AAstakhov\Tests\Component;

use AAstakhov\Component\HttpResponse;

class HttpResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSend()
    {
        $response = new HttpResponse();
        $response->setBody('Houston, do you copy?');

        ob_start();

        $response->send();
        $headers = xdebug_get_headers();
        $result = ob_get_contents();

        ob_end_clean();

        $this->assertEquals('Houston, do you copy?', $result);
        $this->assertArraySubset(['Content-Type: application/json; charset=UTF-8'], $headers);
    }
}
