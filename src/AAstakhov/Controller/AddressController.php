<?php

namespace AAstakhov\Controller;

use AAstakhov\DataStorage\CsvDataStorage;
use AAstakhov\DataStorage\Exceptions\RecordNotFoundException;

/**
 * Controller for getting address data
 */
class AddressController
{
    public function getAddressAction($requestParameters)
    {
        $id = $requestParameters['id'];

        $dataStorage = new CsvDataStorage();
        $filePath = realpath(__DIR__.'/../../../web/example.csv');

        try {
            $dataStorage->setDataSource(['file' => $filePath]);
            $address = $dataStorage->getRecord($id);

            return json_encode($address);
        } catch (RecordNotFoundException $exception) {
            return null;
        }
    }
}