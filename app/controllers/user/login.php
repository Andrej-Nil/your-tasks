<?php

$title = title('Вход');
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db = \classes\App::get(\classes\Db::class);
    $validator = \classes\App::get(\classes\Validator::class);

    $fillable = ['email', 'password'];

    $data = load($fillable);
    $validation = $validator->validate($data, [
        'email' => [
            'required' => true,
        ],
        'password' => [
            'required' => true,
        ]
    ]);

    if(!$validation->hasErrors()){

        $user = $db->query('SELECT * FROM users WHERE email=?', [$data['email']])->find();

        if($user) {
            if(password_verify($data['password'], $user['password'])){
                $_SESSION['user'] = getUserData($user);
                $_SESSION['success'] = 'Вы успешно авторизовались';
                redirect(PATH);
            }else{
                $_SESSION['error'] = 'Почта или пароль не совподают';
                redirect();
            }
        } else {
            $_SESSION['error'] = 'Почта или пароль не совподают';
            redirect();
        }

    } else{
        require_once VIEWS . '/user/login.tpl.php';
    }



} else {
    require_once VIEWS . '/user/login.tpl.php';
}

