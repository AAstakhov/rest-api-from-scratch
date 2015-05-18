<?php

namespace AAstakhov\DataStorage;

use AAstakhov\DataStorage\Exceptions\DataSourceException;
use AAstakhov\DataStorage\Exceptions\RecordNotFoundException;
use AAstakhov\DataStorage\Exceptions\WrongRecordDataException;
use AAstakhov\Interfaces\DataStorageInterface;

class CsvDataStorage implements DataStorageInterface
{
    /**
     * @var string
     */
    protected $filePath;
    /**
     * @var array
     */
    protected $header;

    /**
     * @inheritdoc
     */
    public function getRecord($id)
    {
        $records = $this->fetchRecordsFromFile($this->filePath);
        if (!isset($records[$id])) {
            throw new RecordNotFoundException(sprintf('Record %d not found in the data storage', $id));
        }

        $result = $records[$id];

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function addRecord(array $record)
    {
        $this->validateRecord($record);

        $file = fopen($this->filePath, 'a');
        $result = fputcsv($file, $record);
        fclose($file);

        if ($result === false) {
            // @todo: process failed attempt to write
        }
    }

    /**
     * @inheritdoc
     */
    public function updateRecord($id, array $record)
    {
        $this->validateRecord($record);

        $records = $this->fetchRecordsFromFile($this->filePath);
        $records[$id] = $record;

        $this->saveRecordsToFile($records);
    }

    /**
     * @inheritdoc
     */
    public function deleteRecord($id)
    {
        $records = $this->fetchRecordsFromFile($this->filePath);

        if (!isset($records[$id])) {
            throw new RecordNotFoundException(sprintf('Record %d not found in the data storage', $id));
        }

        unset($records[$id]);

        $this->saveRecordsToFile($records);
    }

    /**
     * Reads csv file to array
     *
     * @param string $filePath
     * @return array
     */
    private function fetchRecordsFromFile($filePath)
    {
        $records = [];

        $file = fopen($filePath, 'r');
        while (($line = fgetcsv($file)) !== false) {
            $records[] = array_combine($this->header, $line);
        }

        fclose($file);

        return $records;
    }

    /**
     * @param array $record
     * @throws WrongRecordDataException
     */
    private function validateRecord(array $record)
    {
        if (count($record) != count($this->header)) {
            throw new WrongRecordDataException('Record must have as many elements as the header: '.count($this->header));
        }
    }

    /**
     * @param array $records
     */
    protected function saveRecordsToFile(array $records)
    {
        $file = fopen($this->filePath, 'w');

        foreach ($records as $record) {
            fputcsv($file, $record);
        }

        fclose($file);
    }

    /**
     * @inheritdoc
     */
    public function setDataSource(array $parameters)
    {
        if (!isset($parameters['file'])) {
            throw new DataSourceException('File path is not defined for csv data storage.');
        }
        if (!isset($parameters['header'])) {
            throw new DataSourceException('Header array is not defined for csv data storage.');
        }

        $this->filePath = $parameters['file'];
        $this->header = $parameters['header'];
    }
}