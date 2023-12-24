<?php
use classes\Router;
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require dirname(__DIR__) . '/config/config.php';
require_once __DIR__ . '/boostrap.php';
require CORE . '/funcs.php';



$router = new Router();

require_once CONFIG . '/routes.php';

$router->match();


