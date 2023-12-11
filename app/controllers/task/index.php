<?php

$tasks = $db->query("SELECT * FROM `tasks`")->fetchAll();
require_once VIEWS . '/task/index.tpl.php';