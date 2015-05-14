<?php

class ExampleTest extends PHPUnit_Framework_TestCase
{
    public function testRequest()
    {
        $client = new GuzzleHttp\Client();
        $response = $client->get('http://trycatch.local/example.php/address?id=1');

        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals(['name' => 'Marcin', 'phone' => '502145785', 'street' => 'Opata Rybickiego 1'],
            $response->json());
    }
}