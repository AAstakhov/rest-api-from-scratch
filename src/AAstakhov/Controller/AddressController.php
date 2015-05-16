<?php

namespace AAstakhov\Controller;

use AAstakhov\DataStorage\CsvDataStorage;
use AAstakhov\DataStorage\Exceptions\RecordNotFoundException;
use AAstakhov\Interfaces\ContainerInterface;
use AAstakhov\Interfaces\DataStorageInterface;

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

        /** @var DataStorageInterface $dataStorage */
        $dataStorage = $this->container->get('data-storage');

        try {
            $address = $dataStorage->getRecord($id);
            return json_encode($address);
        } catch (RecordNotFoundException $exception) {
            return null;
        }
    }
}