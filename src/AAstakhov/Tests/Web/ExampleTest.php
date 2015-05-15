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
}