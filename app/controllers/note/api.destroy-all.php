<?php

$db = \classes\App::get(\classes\Db::class);
$auth = \classes\App::get(\classes\Auth::class);


$user = $auth->get();

$result = $db->query("SELECT * FROM `notes` WHERE `user_id`=?", [$user['id']])->findAll();

if($result){
    $deleteCount = $db->query("DELETE FROM `notes` WHERE `user_id`=?", [$user['id']])->rowCount();
if($deleteCount){
    echo json_encode([
        'success' => 'Заметки успешно удаленны',
        'data' => ['delete_count' => $deleteCount]
    ]);
}else{
    echo json_encode(['error' => 'Упс, похоже что то пошло не так.']);
}
    die;
} else {
    echo json_encode(['error' => 'У вас нет заметок']);
}

die;

