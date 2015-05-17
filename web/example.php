<?php

require_once('../src/autoload.php');

use AAstakhov\Component\Application;
use AAstakhov\Interfaces\RouterInterface;
use AAstakhov\Interfaces\HttpResponseInterface;

$app = new Application();

/** @var RouterInterface $router */
$router = $app->getContainer()->get('router');

$path = $_SERVER['PATH_INFO'];
/** @var HttpResponseInterface $response */
$response = $router->execute($path, $_GET);
$response->send();