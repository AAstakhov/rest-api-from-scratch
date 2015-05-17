<?php

namespace AAstakhov\Tests\DataStorage;

use AAstakhov\DataStorage\CsvDataStorage;
use AAstakhov\Interfaces\DataStorageInterface;

class CsvDataStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DataStorageInterface
     */
    private $csv;
    /**
     * @var string
     */
    private $fixturePath;

    protected function setUp()
    {
        $this->fixturePath = __DIR__.'/fixtures/example.csv';
        $this->restoreFixture();
        $this->csv = new CsvDataStorage();
        $this->csv->setDataSource([
            'file' => $this->fixturePath,
            'header' => [0, 1]
        ]);
    }

    public function testGetRecord()
    {
        $record = $this->csv->getRecord(1);

        $expected = [0 => 'c', 1 => 'd'];
        $this->assertEquals($expected, $record);
    }

    /**
     * @expectedException \AAstakhov\DataStorage\Exceptions\RecordNotFoundException
     */
    public function testGetMissingRecord()
    {
        $record = $this->csv->getRecord(100);
    }

    public function testUpdateRecord()
    {
        $this->csv->updateRecord(1, ['x', 'y']);
        $lines = array_map('trim', file($this->fixturePath));

        $expected = ['a,b', 'x,y', 'e,f'];
        $this->assertEquals($expected, $lines);
    }

    public function testDeleteRecord()
    {
        $this->csv->deleteRecord(1);
        $lines = array_map('trim', file($this->fixturePath));

        $expected = ['a,b', 'e,f'];
        $this->assertEquals($expected, $lines);
    }

    private function restoreFixture()
    {
        $distFile = realpath(__DIR__.'/fixtures/example.csv.dist');
        $fixtureFile = realpath(__DIR__.'/fixtures/example.csv');

        copy($distFile, $fixtureFile);
    }
}
