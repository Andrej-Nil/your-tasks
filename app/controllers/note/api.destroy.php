<?php

$db = \classes\App::get(\classes\Db::class);
$auth = \classes\App::get(\classes\Auth::class);
$user = $auth->get();
$id = $_POST['id'] ?? 0;
$values = [
    $id,
    $user['id']
];

$note = $db->query('SELECT * FROM `notes` WHERE id=? AND user_id=?', $values)->find();

if($note){
    $res = $db->query('DELETE FROM `notes` WHERE id=? AND user_id=?', $values)->rowCount();

    echo json_encode([
        'success' => 'Заметка успешно удаленна!',
        'data'=>['id' => $note['id']]
    ]);
    if($res){

    } else {
        echo json_encode(['error' => 'Упс, что то пошло не по плану! Заметка не удаленна']);
    }

    die;
}else{
    echo json_encode(['error' => 'Заметки не существует или уже была удалена!']);
}
die;
