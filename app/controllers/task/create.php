<?php

$title = title('Создание задачи');
$auth = \classes\App::get(\classes\Auth::class);
$user = $auth->get();


require_once VIEWS . '/task/create.tpl.php';

