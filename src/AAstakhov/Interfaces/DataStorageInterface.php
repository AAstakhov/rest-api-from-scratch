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
}