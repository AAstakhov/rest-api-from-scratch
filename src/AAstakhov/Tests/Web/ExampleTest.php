<?php

namespace AAstakhov\Tests\Web;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use PHPUnit_Framework_TestCase;

class ExampleTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ClientInterface
     */
    private $client;

    protected function setUp()
    {
        $this->restoreFixture();
        $this->client = new Client();
    }

    /**
     * @dataProvider getExistingRecordsDataProvider
     */
    public function testGetExistingRecords($id, array $record)
    {
        $response = $this->client->get('http://trycatch.local/example.php/address?id='.$id);
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals($record, $response->json());
    }

    public function getExistingRecordsDataProvider()
    {
        return [
            [0, ['name' => 'Michal', 'phone' => '506088156', 'street' => 'Michalowskiego 41']],
            [1, ['name' => 'Marcin', 'phone' => '502145785', 'street' => 'Opata Rybickiego 1']],
            [2, ['name' => 'Piotr', 'phone' => '504212369', 'street' => 'Horacego 23']],
            [3, ['name' => 'Albert', 'phone' => '605458547', 'street' => 'Jan Pawła 67']]
        ];
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     * @expectedExceptionCode 404
     */
    public function testGetMissingRecord()
    {
        $this->client->get('http://trycatch.local/example.php/address?id=1000');
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     * @expectedExceptionCode 404
     */
    public function testGetRecordWithNonIntegerParameter()
    {
        $this->client->get('http://trycatch.local/example.php/address?id=non-integer');
    }

    public function testCreateRecord()
    {
        $response = $this->client->post('http://trycatch.local/example.php/address',
            ['body' => ['Andrey', '0123456789', 'Puerto de la Cruz']]);

        $fixtureFile = realpath(__DIR__.'/../../../../web/example.csv');
        $lines = file($fixtureFile);

        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals(5, count($lines));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     * @expectedExceptionCode 400
     */
    public function testCreateRecordWithWrongParameters()
    {
        $this->client->post('http://trycatch.local/example.php/address', ['body' => ['Andrey']]);
    }

    public function testUpdateRecord()
    {
        $response = $this->client->put('http://trycatch.local/example.php/address?id=1',
            ['body' => ['Andrey', '0123456789', 'Puerto de la Cruz']]);

        $fixtureFile = realpath(__DIR__.'/../../../../web/example.csv');
        $lines = array_map('trim', file($fixtureFile));

        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals($lines[1], 'Andrey,0123456789,"Puerto de la Cruz"');
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     * @expectedExceptionCode 400
     */
    public function testUpdateRecordWithWrongParameters()
    {
        $this->client->put('http://trycatch.local/example.php/address?id=1',
            ['body' => ['Andrey']]);
    }

    public function testDeleteRecord()
    {
        $response = $this->client->delete('http://trycatch.local/example.php/address?id=1');

        $fixtureFile = realpath(__DIR__.'/../../../../web/example.csv');
        $lines = array_map('trim', file($fixtureFile));

        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals(count($lines), 3);
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     * @expectedExceptionCode 404
     */
    public function testDeleteRecordWithWrongParameters()
    {
        $this->client->delete('http://trycatch.local/example.php/address?id=100');
    }

    private function restoreFixture()
    {
        $distFile = realpath(__DIR__.'/../../../../web/example.csv.dist');
        $fixtureFile = realpath(__DIR__.'/../../../../web/example.csv');

        copy($distFile, $fixtureFile);
    }
}