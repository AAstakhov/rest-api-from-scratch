<?php

class ExampleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getExistingRecordsDataProvider
     */
    public function testGetExistingRecords($id, array $record)
    {
        $client = new GuzzleHttp\Client();

        $response = $client->get('http://trycatch.local/example.php/address?id=' . $id);
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
        $client = new GuzzleHttp\Client();

        $response = $client->get('http://trycatch.local/example.php/address?id=1000');
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     * @expectedExceptionCode 404
     */
    public function testGetRecordWithNonIntegerParameter()
    {
        $client = new GuzzleHttp\Client();

        $response = $client->get('http://trycatch.local/example.php/address?id=non-integer');
    }

    public function testCreateRecord()
    {
        $this->restoreFixture();

        $client = new GuzzleHttp\Client();
        $response = $client->post('http://trycatch.local/example.php/address',
            ['Andrey', '0123456789', 'Puerto de la Cruz']);

        $fixtureFile = realpath(__DIR__.'/../../../../web/example.csv');
        $lines = file_get_contents($fixtureFile);

        $this->assertEquals(5, count($lines));
    }

    private function restoreFixture()
    {
        $distFile = realpath(__DIR__.'/../../../../web/example.csv.dist');
        $fixtureFile = realpath(__DIR__.'/../../../../web/example.csv');

        copy($distFile, $fixtureFile);
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     * @expectedExceptionCode 400
     */
    public function testCreateRecordWithWrongParameters()
    {
        $this->restoreFixture();

        $client = new GuzzleHttp\Client();
        $client->post('http://trycatch.local/example.php/address', ['Andrey']);
    }
}