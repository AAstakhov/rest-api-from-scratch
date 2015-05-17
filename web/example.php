<?php

require_once('../src/autoload.php');

use AAstakhov\Component\Application;
use AAstakhov\Interfaces\RouterInterface;
use AAstakhov\Interfaces\HttpResponseInterface;

$app = new Application();

/** @var RouterInterface $router */
$router = $app->getContainer()->get('router');

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'];
$parameters = ($method == 'GET') ? $_GET : $_POST;

/** @var HttpResponseInterface $response */
$response = $router->execute($path, $method, $parameters);
$response->send();