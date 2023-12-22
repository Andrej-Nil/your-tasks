<?php


$db = \classes\App::get(\classes\Db::class);
//echo json_encode($_POST);

$api_data = json_decode(file_get_contents('php://input'), true);

$data = $api_data ?? $_POST;

$id = $data['id'] ?? 0;
//$id = 700;

$db->query("DELETE FROM tasks WHERE id = ?", [$id]);
if($db->rowCount()){
    $res['answer'] = $_SESSION['success'] = "Задача удалена";
}else{
    $res['answer'] = $_SESSION['error'] = "При удалении произошла ошибка";
}

if($api_data) {
    echo json_encode($res);
    die;
}

redirect('/tasks');
