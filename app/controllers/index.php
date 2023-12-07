<?php

$tasks = $db->query("SELECT * FROM `tasks`")->fetchAll();
//$tasks = $db->query("SELECT * FROM `tasks` WHERE `status` NOT IN ('completed')")->fetchAll();

require_once VIEWS . '/home.tpl.php';

