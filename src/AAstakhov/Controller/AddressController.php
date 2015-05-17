<?php

namespace AAstakhov\Controller;

use AAstakhov\DataStorage\Exceptions\RecordNotFoundException;
use AAstakhov\DataStorage\Exceptions\WrongRecordDataException;
use AAstakhov\Interfaces\DataStorageInterface;
use AAstakhov\Interfaces\HttpRequestInterface;
use AAstakhov\Interfaces\HttpResponseInterface;
use AAstakhov\Interfaces\ViewInterface;
use Exception;

/**
 * Controller for getting address data
 */
class AddressController extends BaseController
{
    /**
     * @param HttpRequestInterface $request
     * @return HttpResponseInterface
     */
    public function getAddressAction(HttpRequestInterface $request)
    {
        $id = $request->getGetVariables()['id'];

        /** @var DataStorageInterface $dataStorage */
        $dataStorage = $this->getContainer()->get('data-storage');
        /** @var ViewInterface $view */
        $view = $this->getContainer()->get('view');

        try {
            $address = $dataStorage->getRecord($id);
            $responseText = $view->render(['record' => $address]);

            $this->getResponse()->setBody($responseText);

        } catch (Exception $exception) {
            $this->processException($exception);
        }

        return $this->getResponse();
    }

    /**
     * @param Exception $exception
     */
    private function processException(Exception $exception)
    {
        $statusCode = 500;
        if ($exception instanceof RecordNotFoundException) {
            $statusCode = 404;
        } elseif ($exception instanceof WrongRecordDataException) {
            $statusCode = 400;
        }
        $this->getResponse()
            ->setStatusCode($statusCode)
            ->setBody($exception->getMessage());
    }

    /**
     * @param HttpRequestInterface $request
     * @return HttpResponseInterface
     */
    public function createAddressAction(HttpRequestInterface $request)
    {
        /** @var DataStorageInterface $dataStorage */
        $dataStorage = $this->getContainer()->get('data-storage');
        try {
            $dataStorage->addRecord($request->getPostVariables());
        } catch (Exception $exception) {
            $this->processException($exception);
        }

        return $this->getResponse();
    }
}