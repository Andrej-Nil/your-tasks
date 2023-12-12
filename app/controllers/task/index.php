<?php

$tasks = $db->query("SELECT * FROM `tasks`")->findAll();
require_once VIEWS . '/task/index.tpl.php';