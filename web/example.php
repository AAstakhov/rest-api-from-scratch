<?php

require_once('../src/autoload.php');

use AAstakhov\Component\Application;
use AAstakhov\Interfaces\RouterInterface;

$app = new Application();

/** @var RouterInterface $router */
$router = $app->getContainer()->get('router');

$path = $_SERVER['PATH_INFO'];
print $router->execute($path, $_GET);