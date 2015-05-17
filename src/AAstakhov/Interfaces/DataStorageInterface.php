<?php

namespace AAstakhov\Interfaces;

/**
 * Interface for data storage
 */
interface DataStorageInterface
{
    /**
     * Gets record by id
     *
     * @param integer $id
     * @return array
     * @throws RecordNotFoundException
     */
    public function getRecord($id);

    /**
     * Adds new record
     *
     * @param array $record
     * @return $this
     */
    public function addRecord(array $record);

    /**
     * Updates a record with the given id
     *
     * @param $id
     * @param array $record
     * @return $this
     */
    public function updateRecord($id, array $record);

    /**
     * Deletes a record with the given id
     *
     * @param $id
     * @return $this
     */
    public function deleteRecord($id);

    /**
     * Sets data storage source
     *
     * @param array $parameters
     * @return void
     */
    public function setDataSource(array $parameters);
}