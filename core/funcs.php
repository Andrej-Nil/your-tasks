<?php



function dump($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function print_arr($data){
    echo "<pre>";
    print_r($data);
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
        return "Сегодня";
        }elseif ($difference->invert){
            return "Просрочено на {$difference->days}";
        } else {
            return $difference->days;
        }
    }else{
        return 'Не указано';
    }

}

    function getDifferenceTime($start, $end){
        $startTime = new DateTime($start);
        $endTime = new DateTime($end);
        return $startTime->diff($endTime);
    }


function getTaskStatusCls($task) {
    if($task['status'] === 'cancelled') {
        return $task['status'];
    }
    if($task['status'] === 'completed') {
        return $task['status'];
    }
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


function load($fillable = []){
    $data = [];

    foreach (($_POST) as $k => $v){
        if(in_array($k, $fillable)){
            $data[$k] = trim($v);
        }
    }

    return $data;
}

function old($fieldname){
    return isset($_POST[$fieldname]) ? h($_POST[$fieldname]) : '';
}

function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

function redirect($url = ''){
    if($url) {
        $redirect = $url;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }

    header("Location: {$redirect}");
    die;
}

function  getAlerts(){
    if(!empty($_SESSION['success'])){
       $text = $_SESSION['success'];
       $cls = 'alert--success';
       require_once VIEWS . '/incs/alert.tpl.php';
       unset($_SESSION['success']);


    }elseif(!empty($_SESSION['error'])){
        $text = $_SESSION['error'];
        $cls = 'alert--error';
        require_once VIEWS . '/incs/alert.tpl.php';
        unset($_SESSION['error']);

    }
}

function db(): \classes\Db{
    return \classes\App::get(\classes\Db::class);
}

function check_auth(){
    return isset($_SESSION['user']);
}

function title($title = ''){
    return "Your Tasks - " . $title;
}

