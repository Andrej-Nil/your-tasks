<?php



function dump($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function dd($data){
    dump($data);
    die;
}

function abort($code = '404'){
    http_response_code($code);
    require VIEWS . "/errors/{$code}.tpl.php";
    die;
}

function timeLeft($endTime)
{

    if($endTime){
        $difference = getDifferenceTime(date("Y-m-d"), $endTime);
        if ($difference->days === 0) {
        return 'Сегодня';
        }elseif ($difference->invert){
            return "Просрочено на {$difference->days}";
        } else {
            return $difference->days;
        }
    }else{
        return 'Не указано';
    }
//

}

    function getDifferenceTime($start, $end){
        $startTime = new DateTime($start);
        $endTime = new DateTime($end);
        return $startTime->diff($endTime);
    }


function getTaskStatusCls($task) {
    if($task['deadline']) {
        $difference = getDifferenceTime(date("Y-m-d"), $task['deadline']);
        if ($difference->invert) {
            return 'expired';
        }
    }
    return $task['status'];


}

function getTaskStatusWord($status) {
    $statusList = [
        'completed' => 'Выполнено',
        'pause' => 'Приостановлено',
        'progress' => 'Активна',
        'cancelled' => 'Отменен',
    ];

    return $statusList[$status];

}

