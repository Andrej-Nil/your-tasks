<?php
$db = \classes\App::get(\classes\Db::class);
$validator = \classes\App::get(\classes\Validator::class);
//dd($validator);
$fillable = ['title', 'description', 'deadline'];
$createDate = date('Y-m-d');

$data = load($fillable);
$values = [
    $data['title'],
    $data['description'],
    'progress',
    $createDate,
    $data['deadline'] ?: null,
];


$validation = $validator->validate($data, [
    "title" => [
        'required' => true,
        'min' => 5,
        'max' => 190
    ],
    "deadline" => [
        'required' => false,
        'relevance' => $createDate
    ]
]);


if (!$validation->hasErrors()) {

    $res = $db->query(
        "INSERT INTO tasks (`title`, `description`, `status`, `date_creating`, `deadline`) VALUES (?,?,?,?,?)",
        $values
    );

    if ($res) {
        $_SESSION['success'] = "Задача успешно добавлена";
    } else {
        $_SESSION['error'] = "Произошла ошибка, задача не добавлена";
    }

    redirect('/');
} else {
    require_once VIEWS . '/task/create.tpl.php';
}