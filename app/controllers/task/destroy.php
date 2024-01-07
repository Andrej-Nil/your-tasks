<?php
$db = \classes\App::get(\classes\Db::class);

$id = $_POST['id'] ?? 0;

$db->query("DELETE FROM tasks WHERE id = ?", [$id]);
if($db->rowCount()){
    $res['answer'] = $_SESSION['success'] = "Задача удалена";
}else{
    $res['answer'] = $_SESSION['error'] = "При удалении произошла ошибка";
}


redirect('tasks');
