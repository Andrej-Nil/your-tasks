<?php

$db = \classes\App::get(\classes\Db::class);
$auth = \classes\App::get(\classes\Auth::class);
$title = title('Просмотр задачи');
$id = $_GET['id'] ?? 0;
$user = $auth->get();

$task = $db->query("SELECT * FROM `tasks` WHERE id=? AND user_id=? LIMIT 1", [$id,$user['id']])->findOrFail();

require_once VIEWS . '/task/show.tpl.php' ;