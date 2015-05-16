<?php

require_once('../src/autoload.php');

use AAstakhov\Component\Router;

$router = new Router();
$router->addRoute('/address', 'AAstakhov\Controller\AddressController', 'getAddress');

$path = $_SERVER['PATH_INFO'];
print $router->execute($path, $_GET);