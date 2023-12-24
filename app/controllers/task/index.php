<?php
$db = \classes\App::get(\classes\Db::class);
$title = title('Задачи');
$tasks = $db->query("SELECT * FROM `tasks`")->findAll();
require_once VIEWS . '/task/index.tpl.php';