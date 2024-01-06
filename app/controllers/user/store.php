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

if(!$validation->hasErrors()){
    $values = [
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => password_hash($data['password'], PASSWORD_DEFAULT),
    ];

    $id = $db->query(
        "INSERT INTO users (`name`, `email`, `password`) VALUES (:name,:email,:password)",
        $values)->getInsertId();
    if ($id) {
       $user = $db->query("SELECT * FROM users WHERE id=?", [$id])->find();
       if($user){
           $_SESSION['user'] = getUserData($user);
           $_SESSION['success'] = "Регистрация прошла успешно";
           redirect(PATH);
       }

        $_SESSION['error'] = "Произошла ошибка, выполните вход";
        redirect(LOGIN_PAGE);
    } else {
        $_SESSION['error'] = "Произошла ошибка, регистрация неудалась";
        require_once VIEWS . '/user/register.tpl.php';
    }

} else {
    require_once VIEWS . '/user/register.tpl.php';
}