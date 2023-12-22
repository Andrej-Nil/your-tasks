<?php
$db = \classes\App::get(\classes\Db::class);
$tasks = $db->query("SELECT * FROM `tasks` WHERE `status` NOT IN ('completed', 'cancelled')")->findAll();

require_once VIEWS . '/home.tpl.php';

