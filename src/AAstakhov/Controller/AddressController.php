<?php

namespace AAstakhov\Controller;

use AAstakhov\DataStorage\Exceptions\RecordNotFoundException;
use AAstakhov\DataStorage\Exceptions\WrongRecordDataException;
use AAstakhov\Interfaces\DataStorageInterface;
use AAstakhov\Interfaces\HttpRequestInterface;
use AAstakhov\Interfaces\HttpResponseInterface;
use AAstakhov\Interfaces\ViewInterface;

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