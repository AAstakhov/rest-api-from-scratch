<?php

require_once('../src/autoload.php');

use AAstakhov\Component\Application;
use AAstakhov\Interfaces\HttpResponseInterface;
use AAstakhov\Interfaces\RouterInterface;

$app = new Application();

/** @var RouterInterface $router */
$router = $app->getContainer()->get('router');
$request = $app->createRequestFromGlobals();

/** @var HttpResponseInterface $response */
$response = $router->execute($request);
$response->send();