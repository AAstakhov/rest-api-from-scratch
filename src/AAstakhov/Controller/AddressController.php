<?php

namespace AAstakhov\Controller;

use AAstakhov\DataStorage\Exceptions\RecordNotFoundException;
use AAstakhov\Interfaces\ContainerInterface;
use AAstakhov\Interfaces\DataStorageInterface;
use AAstakhov\Interfaces\ViewInterface;

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
        /** @var ViewInterface $view */
        $view = $this->container->get('view');

        try {
            $address = $dataStorage->getRecord($id);

            return $view->render(['record' => $address]);
        } catch (RecordNotFoundException $exception) {
            return null;
        }
    }
}