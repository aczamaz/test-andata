<?php
require('vendor/autoload.php');

define('BASEPATH','/App/Views/');

$router = new \Bramus\Router\Router();
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router->get('/', "App\Controllers\MainController@index");

$router->run();