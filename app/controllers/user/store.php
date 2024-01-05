<?php

$db = \classes\App::get(\classes\Db::class);
$validator = \classes\App::get(\classes\Validator::class);

$fillable = ['name', 'email', 'password', 'confirm'];

$data = load($fillable);

$validation = $validator->validate($data, [
    "name" => [
        'required' => true,
//        'min' => 2,
        'max' => 100
    ],
    "email" => [
        'required' => true,
        'max' => 100,
        'unique' => 'users:email'
    ],
    "password" => [
        'required' => true,
        'min' => 6,
    ],
    "confirm" => [
        'match' => 'password'
    ]

]);



$values = [
    'name' => $data['name'],
    'email' => $data['email'],
    'password' => password_hash($data['password'], PASSWORD_DEFAULT),
];

if(!$validation->hasErrors()){
//    dd($validation);
//    $res = $db->query("INSERT INTO users (`name`, `email`, `password`) VALUES (?,?,?)",  $values);
    $res = $db->query(
        "INSERT INTO users (`name`, `email`, `password`) VALUES (:name,:email,:password)",
        $values);
    if ($res) {
        $_SESSION['success'] = "Регистрация прошла успешно";
        redirect('/');
    } else {
        $_SESSION['error'] = "Произошла ошибка, регистрация неудалась";
        require_once VIEWS . '/user/register.tpl.php';
    }

} else {
    require_once VIEWS . '/user/register.tpl.php';
}