<?php

$db = \classes\App::get(\classes\Db::class);
$auth = \classes\App::get(\classes\Auth::class);
$user = $auth->get();

$title = title('Редастирование Задачи');

$id = $_GET['id'] ?? 0;

$task = $db->query("SELECT * FROM tasks WHERE id=? LIMIT 1", [$id])->findOrFail();

require_once VIEWS . '/task/edit.tpl.php';