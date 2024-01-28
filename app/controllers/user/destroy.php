<?php

$db = \classes\App::get(\classes\Db::class);
$auth = \classes\App::get(\classes\Auth::class);
$user = $auth->get();


$user = $db->query("SELECT * FROM `users` WHERE `email`=?", [$user['email']])->find();

if($user){
    $notes = $db->query("SELECT * FROM `notes` WHERE `user_id`=?", [$user['id']])->findAll();

    $tasks = $db->query("SELECT * FROM `tasks` WHERE `user_id`=?", [$user['id']])->findAll();

    if($notes){
        $deleteNotesCount = $db->query("DELETE FROM `notes` WHERE `user_id`=?", [$user['id']])->rowCount();
    }

    if($tasks){
        $deleteTasksCount = $db->query("DELETE FROM `tasks` WHERE `user_id`=?", [$user['id']])->rowCount();
    }

    $result = $db->query("DELETE FROM `users` WHERE `id`=? AND `email`=?" , [$user['id'], $user['email']])->rowCount();

    if($result){
        $auth->logout();
        redirect(PATH . '/welcome');
    } else{
        $error = 'При удалении, попробйте обновить страницу и поробывать снова';
        $title = title('Профиль');
        $activeTab = 'deleteProfile';
        require_once VIEWS . '/user/profile.tpl.php';
    }

   redirect('/');
} else {
    $error = 'Ошибка. Пользователя не существует или уже удален';
    $title = title('Добро пожаловать');
    require_once VIEWS . 'welcome.tpl.php';
}

die;

