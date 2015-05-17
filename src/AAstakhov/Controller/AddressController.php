<?php

namespace AAstakhov\Controller;

use AAstakhov\DataStorage\Exceptions\RecordNotFoundException;
use AAstakhov\Interfaces\DataStorageInterface;
use AAstakhov\Interfaces\ViewInterface;

/**
 * Controller for getting address data
 */
class AddressController extends BaseController
{
    public function getAddressAction($requestParameters)
    {
        $id = $requestParameters['id'];

        /** @var DataStorageInterface $dataStorage */
        $dataStorage = $this->getContainer()->get('data-storage');
        /** @var ViewInterface $view */
        $view = $this->getContainer()->get('view');

        try {
            $address = $dataStorage->getRecord($id);

            return $view->render(['record' => $address]);
        } catch (RecordNotFoundException $exception) {
            return null;
        }
    }
}