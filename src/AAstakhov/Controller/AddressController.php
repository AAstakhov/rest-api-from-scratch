<?php

namespace AAstakhov\Controller;

use AAstakhov\DataStorage\Exceptions\RecordNotFoundException;
use AAstakhov\DataStorage\Exceptions\WrongRecordDataException;
use AAstakhov\Interfaces\DataStorageInterface;
use AAstakhov\Interfaces\HttpResponseInterface;
use AAstakhov\Interfaces\ViewInterface;

/**
 * Controller for getting address data
 */
class AddressController extends BaseController
{
    /**
     * @param array $requestParameters
     * @return HttpResponseInterface
     */
    public function getAddressAction(array $requestParameters)
    {
        $id = $requestParameters['id'];

        /** @var DataStorageInterface $dataStorage */
        $dataStorage = $this->getContainer()->get('data-storage');
        /** @var ViewInterface $view */
        $view = $this->getContainer()->get('view');

        try {
            $address = $dataStorage->getRecord($id);
            $responseText = $view->render(['record' => $address]);

            $this->getResponse()->setBody($responseText);

        } catch (RecordNotFoundException $exception) {
            $this->getResponse()
                ->setStatusCode(404)
                ->setBody($exception->getMessage());

        } catch (\Exception $exception) {
            $this->getResponse()
                ->setStatusCode(500)
                ->setBody($exception->getMessage());
        }

        return $this->getResponse();
    }

    public function createAddressAction(array $requestParameters)
    {
        /** @var DataStorageInterface $dataStorage */
        $dataStorage = $this->getContainer()->get('data-storage');
        try {
            $dataStorage->addRecord($requestParameters);
        } catch (WrongRecordDataException $exception) {
            $this->getResponse()
                ->setStatusCode(400)
                ->setBody($exception->getMessage());

        } catch (\Exception $exception) {
            $this->getResponse()
                ->setStatusCode(500)
                ->setBody($exception->getMessage());
        }

        return $this->getResponse();
    }
}