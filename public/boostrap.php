<?php

use classes\ServiceContainer;
use classes\App;
use classes\Db;
use classes\Validator;
$container = new ServiceContainer();

$container->setServices(Db::class, function () {
    $db_config = require CONFIG . '/db.php';
    return (Db::class::getInstance()->getConnection($db_config));
});

$container->setServices(Validator::class, function () {
//    $db_config = require CONFIG . '/validator.php';
    return new Validator();
});

App::setContainer($container);