<?php

$db = \classes\App::get(\classes\Db::class);
$validator = \classes\App::get(\classes\Validator::class);
$auth = \classes\App::get(\classes\Auth::class);
$user = $auth->get();
$fillable = ['text', 'color'];
$data = load($fillable);
if(!array_key_exists('color', $data)){
    $data['color'] = 'white';
}



$validation = $validator->validate($data, [
    'text'=>[
        'required' => true,
        'max' => 191,
    ],
    'color' => [
        'required' => true,
    ]
]);

if(!$validation->hasErrors()){
    $values = [
        $data['text'],
//        getColor($data['color']),
        $user['id']
    ];



    echo json_encode([
        'success' => 'Заметка успешно созданна',
        'data'=> $data]
    );

}
else{
    $errors = [];
    foreach($validator->getErrors() as $key => $values ){
        foreach ($values as $error) {
            $errors[] =  $error;
        }
    };

    echo json_encode(['error'=>$errors]);
}

