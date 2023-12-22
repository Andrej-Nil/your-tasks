<?php
$db = \classes\App::get(\classes\Db::class);
$tasks = $db->query("SELECT * FROM `tasks`")->findAll();
require_once VIEWS . '/task/index.tpl.php';