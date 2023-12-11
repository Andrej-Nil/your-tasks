<?php

$id = $_GET['id'] ?? 0;
$task = $db->query("SELECT * FROM tasks WHERE id={$id}")->find();
dump($task);
require_once VIEWS . '/task/show.tpl.php' ;