<?php

//$tasks = $db->query("SELECT * FROM `tasks`")->fetchAll();
$tasks = $db->query("SELECT * FROM `tasks` WHERE `status` NOT IN ('completed', 'cancelled')")->findAll();
//dd($tasks);
require_once VIEWS . '/home.tpl.php';

