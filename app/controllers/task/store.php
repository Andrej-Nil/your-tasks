<?php


$db = \classes\App::get(\classes\Db::class);
$validator = \classes\App::get(\classes\Validator::class);

$fillable = ['title', 'description', 'deadline'];
$createDate = date('Y-m-d');

$data = load($fillable);
$values = [
    $data['title'],
    $data['description'],
    'active',
    $createDate,
    $data['deadline'] ?: null,
    $_SESSION['user']['id']
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
        "INSERT INTO tasks (`title`, `description`, `status`, `date_creating`, `deadline`, `user_id`) VALUES (?,?,?,?,?,?)",
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
