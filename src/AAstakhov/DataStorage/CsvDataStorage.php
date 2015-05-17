<?php

namespace AAstakhov\DataStorage;

use AAstakhov\DataStorage\Exceptions\DataSourceException;
use AAstakhov\DataStorage\Exceptions\RecordNotFoundException;
use AAstakhov\DataStorage\Exceptions\WrongRecordDataException;
use AAstakhov\Interfaces\DataStorageInterface;

class CsvDataStorage implements DataStorageInterface
{
    protected $filePath;

    public function getRecord($id)
    {
        $records = $this->fetchAddressesFromFile($this->filePath);
        if (!isset($records[$id])) {
            throw new RecordNotFoundException(sprintf('Record %d not found in the data storage', $id));
        }

        $result = $records[$id];

        return $result;
    }

    private function fetchAddressesFromFile($filePath)
    {
        $records = [];

        $file = fopen($filePath, 'r');
        while (($line = fgetcsv($file)) !== false) {
            $records[] = [
                'name' => $line[0],
                'phone' => $line[1],
                'street' => $line[2]
            ];
        }

        fclose($file);

        return $records;
    }

    public function setDataSource(array $parameters)
    {
        if (!isset($parameters['file'])) {
            throw new DataSourceException('File path is not defined for csv data storage.');
        }

        $this->filePath = $parameters['file'];
    }

    /**
     * Adds new record
     *
     * @param array $record
     * @return $this
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
     * @param array $record
     * @throws WrongRecordDataException
     */
    private function validateRecord(array $record)
    {
        // @todo: smarter validation is desired
        if (count($record) != 3) {
            throw new WrongRecordDataException('Record must have 3 items');
        }
    }
}