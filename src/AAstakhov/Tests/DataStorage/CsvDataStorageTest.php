<?php

namespace AAstakhov\Tests\DataStorage;

use AAstakhov\DataStorage\CsvDataStorage;

class CsvDataStorageTest extends \PHPUnit_Framework_TestCase
{
    public function testGetRecord()
    {
        $csv = new CsvDataStorage();
        $csv->setDataSource(['file' => 'fixtures/example.csv']);

        $record = $csv->getRecord(1);

        $expected = ['name' => 'Marcin', 'phone' => '502145785', 'street' => 'Opata Rybickiego 1'];
        $this->assertEquals($expected, $record);
    }
}
