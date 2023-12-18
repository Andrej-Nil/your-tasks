<?php

//require_once CORE . '/classes/Validator.php';
use classes\Validator;


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




   if(!$validation->hasErrors()){

           $res = $db->query(
               "INSERT INTO tasks (`title`, `description`, `status`, `date_creating`, `deadline`) VALUES (?,?,?,?,?)",
               $values
           );

           if($res){
               $_SESSION['success'] = "Success";
           } else {
               $_SESSION['error'] = "Db error";

           }

           redirect();
   }

}

require_once VIEWS . '/task/create.tpl.php';

