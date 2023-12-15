<?php
//
//if($_SERVER['REQUEST_METHOD'] === 'POST'){
//    $fillable = ['title', 'description', 'deadline'];
//    $data = load($fillable);
//    $createDate = date('Y-m-d');
//    $difference = getDifferenceTime($createDate, $data['deadline']);
//    $values = [
//        $data['title'],
//        $data['description'],
//        'progress',
//        $createDate,
//        $data['deadline'],
//    ];
//
//
//
//    $errors = [];
//
//    if(empty(trim($data['title']))){
//        $errors['title'] = "Поле 'название' обязательно!";
//    }
//
//    if($difference->invert > 0){
//        $errors['deadline'] = "Дата здачи не может быть раньше даты создания!";
//    }
//
//    if(empty($errors)){
//        $db->query(
//            "INSERT INTO tasks (`title`, `description`, `status`, `date_creating`, `deadline`) VALUES (?,?,?,?,?)",
//            $values
//        );
//    } else {
//
//    }
//    require_once VIEWS . '/task/create.tpl.php';
//}
//
