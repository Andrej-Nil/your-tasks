<?php
$db = \classes\App::get(\classes\Db::class);

$id = $_POST['id'] ?? 0;

$task = $db->query("SELECT * FROM tasks WHERE id=? LIMIT 1", [$id])->find();


if ($task) {
    if ($task['status'] === 'completed') {
        echo json_encode(['error' => 'Задача была завершена']);
        die;
    }
    if($task['status'] === 'cancelled'){
        echo json_encode(['error' => 'Задача была отменена. Что бы завершить задачу, необходимо возобновить ее']);
        die;
    }
    $statusData = $task['status'] === 'progress' ? getStatusData('pause', $task) : getStatusData('progress', $task);

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
    }else {
        echo json_encode(['error' => 'Упс! При сохранении, что-то пошло не по плану!']);
    }
    die;
} else {
    echo json_encode(['error' => 'Задача не существует или была удаленна']);
    die;
}



