<?php
$db = \classes\App::get(\classes\Db::class);

$id = $_POST['id'] ?? 0;

$task = $db->query("SELECT * FROM tasks WHERE id=? LIMIT 1", [$id])->find();


if ($task) {
    if ($task['status'] === 'complete') {
        echo json_encode(['error' => 'Задача была завершина']);
        die;
    }
    $statusData = $task['status'] === 'progress' ? getStatusData('pause') : getStatusData('progress');

    $statusData['id'] = $task['id'];
    $value = [
        $statusData['status'],
        $statusData['id']
    ];

    $result = $db->query("UPDATE tasks SET status=? WHERE id=? LIMIT 1", $value)->rowCount();

    if($result){
        $data = [
            'success' => 'Статус успешно изменён',
            'data' => $statusData
        ];
        echo json_encode($data);
        die;
    }else{
        echo json_encode(['error' => 'Упс! При сохранении, что то пошло не по плану!']);
        die;
    }


//    if($task['status'] === 'progress'){
//        echo json_encode(['status'=>$task['status'], 'new_status'=>$newStatus]);
//    }else if($task['status'] === 'pause'){
//        echo json_encode(['status'=>$task['status'], 'new_status'=>$newStatus]);
//    }
} else {
    echo json_encode(['error' => 'Задача не существует или была удаленна']);
    die;
}



