<?php

return [
    'host' => 'localhost',
    'dbname' => 'your_tasks',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8', //utf8mb4
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ],

];