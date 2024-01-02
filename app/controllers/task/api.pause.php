<?php

$db = \classes\App::get(\classes\Db::class);

$id = $_POST['id'] ?? 0;

$task = $db->query('SELECT * FROM tasks WHERE id=? LIMIT 1', [$id])->find();


if($task) {
    if($task['status'] === 'completed'){
        echo json_encode(['error'=>'Выполненые задачи не могут быть остановлены']);
        die;
    }

    if($task['status'] === 'cancelled'){
        echo json_encode(['error'=>'Отмененые задачи не могут быть остановлены']);
        die;
    }

    $statusData = getStatusData('pause', 'pause', $task);

    $values = [
        $statusData['status'],
        $statusData['id']
    ];

    $result = $db->query('UPDATE tasks SET status=? WHERE id=? LIMIT 1', $values)->rowCount();
    if($result){
        echo json_encode([
            'success'=>'Задача успешно остановлинна',
            'data'=>$statusData
        ]);
    } else{
        echo json_encode(['error'=>'Упс, что то пошло не так']);
    }
    die;
} else{
    echo json_encode(['error'=>'Задачи не существует или была удаленна']);
}

die;