<?php
$db = \classes\App::get(\classes\Db::class);


$auth = \classes\App::get(\classes\Auth::class);
$user = $auth->get();
$activeTab = 'personal';
$title = 'Your Task - Профиль';

require_once VIEWS . '/user/profile.tpl.php';