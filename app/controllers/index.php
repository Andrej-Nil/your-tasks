<?php

$tasks = $db->query("SELECT * FROM `task`")->fetchAll();
//$task = $db->query("SELECT * FROM `task` WHERE `status` NOT IN ('completed')")->fetchAll();

require_once VIEWS . '/home.tpl.php';

