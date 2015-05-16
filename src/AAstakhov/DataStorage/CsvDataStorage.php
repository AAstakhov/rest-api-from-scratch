<?php

namespace AAstakhov\DataStorage;

use AAstakhov\DataStorage\Exceptions\DataSourceException;
use AAstakhov\Interfaces\DataStorageInterface;
use AAstakhov\Interfaces\RecordNotFoundException;

class CsvDataStorage implements DataStorageInterface
{
    protected $filePath;

    public function getRecord($id)
    {
        // TODO: Implement getRecord() method.
    }

    public function setDataSource(array $parameters)
    {
        if (!isset($parameters['file'])) {
            throw new DataSourceException('File path is not defined for csv data storage.');
        }

        $this->filePath = $parameters['file'];
    }
}