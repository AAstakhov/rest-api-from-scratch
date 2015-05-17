<?php

require_once('../src/autoload.php');

use AAstakhov\Component\Application;
use AAstakhov\Interfaces\HttpResponseInterface;
use AAstakhov\Interfaces\RouterInterface;

$app = new Application();

/** @var RouterInterface $router */
$router = $app->getContainer()->get('router');

$request = new \AAstakhov\Component\HttpRequest($_SERVER['PATH_INFO'], $_SERVER['REQUEST_METHOD'], $_GET, $_POST);

/** @var HttpResponseInterface $response */
$response = $router->execute($request);
$response->send();