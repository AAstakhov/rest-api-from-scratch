<?php

namespace AAstakhov\Controller;

use AAstakhov\DataStorage\CsvDataStorage;
use AAstakhov\DataStorage\Exceptions\RecordNotFoundException;
use AAstakhov\Interfaces\ContainerInterface;

/**
 * Controller for getting address data
 */
class AddressController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

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