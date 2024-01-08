<?php

use classes\ServiceContainer;
use classes\App;
use classes\Db;
use classes\Validator;
use classes\Auth;
$container = new ServiceContainer();

$container->setServices(Db::class, function () {
    $db_config = require CONFIG . '/db.php';
    return (Db::class::getInstance()->getConnection($db_config));
});

$container->setServices(Validator::class, function () {
    return new Validator();
});

$container->setServices(\classes\Auth::class, function() {
    return new Auth();
});

App::setContainer($container);