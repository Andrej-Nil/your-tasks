<?php

require_once CORE . '/classes/Validator.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $fillable = ['title', 'description', 'deadline'];
    $createDate = date('Y-m-d');

    $validator = new Validator();

    $data = load($fillable);
    $values = [
        $data['title'],
        $data['description'],
        'progress',
        $createDate,
        $data['deadline'] ? : null,
    ];



    $validation = $validator->validate($data, [
        "title"=> [
            'required' => true,
            'min' => 5,
            'max'=>190
        ],
        "deadline" => [
            'required' => false,
            'relevance' => $createDate
        ]

    ]);




   if($validation->hasErrors()){
       print_arr($validation->getErrors());
   }else{
       echo 'SUCCESS';
   };

    die;

//

//    if(empty($data['title'])){
//        $errors['title'] = "Поле 'название' обязательно!";
//    }

//dd($values);
    if(empty($errors)){
        $res = $db->query(
            "INSERT INTO tasks (`title`, `description`, `status`, `date_creating`, `deadline`) VALUES (?,?,?,?,?)",
            $values
        );

        if($res){
            echo 'OK';
//            $_SESSION['success'];
        } else {
            echo 'ERROR';
        }
//        redirect('task/create');
    }
    require_once VIEWS . '/task/create.tpl.php';
}

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once VIEWS . '/task/create.tpl.php';
}

