<?php

namespace AAstakhov\Component;

use AAstakhov\Controller\AddressController;
use AAstakhov\DataStorage\CsvDataStorage;
use AAstakhov\Interfaces\ApplicationInterface;
use AAstakhov\Interfaces\ContainerInterface;
use AAstakhov\View\JsonView;

class Application implements ApplicationInterface
{
    protected $container;

    /**
     * @inheritdoc
     */
    public function getContainer()
    {
        if ($this->container) {
            return $this->container;
        }

        $this->container = $this->buildContainer();;

        return $this->container;
    }

    /**
     * @inheritdoc
     */
    public function createRequestFromGlobals()
    {
        $postVariables = $_POST;
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            parse_str(file_get_contents('php://input'), $postVariables);
        }

        return new HttpRequest($_SERVER['PATH_INFO'], $_SERVER['REQUEST_METHOD'], $_GET,
            $postVariables);
    }

    /**
     * @return ContainerInterface
     */
    protected function buildContainer()
    {
        $container = new Container();

        // Register Data storage
        $container->add('data-storage', function () {
            $dataStorage = new CsvDataStorage();
            $filePath = realpath(__DIR__.'/../../../web/example.csv');
            $dataStorage->setDataSource(
                [
                    'file' => $filePath,
                    'header' => ['name', 'phone', 'street']
                ]);

            return $dataStorage;
        });

        // Register json view
        $container->add('view', function () {
            return new JsonView();
        });

        // Register Address controller
        $container->add('controller.address', function () use ($container) {
            $controller = new AddressController($container);

            return $controller->setResponse(new HttpResponse());
        });

        // Register Router
        $container->add('router', function () use ($container) {
            $router = new Router($container);
            $router
                ->addRoute('/address', 'GET', 'controller.address', 'getAddress')
                ->addRoute('/address', 'POST', 'controller.address', 'createAddress')
                ->addRoute('/address', 'PUT', 'controller.address', 'updateAddress')
                ->addRoute('/address', 'DELETE', 'controller.address', 'deleteAddress');

            return $router;
        });

        return $container;
    }
}