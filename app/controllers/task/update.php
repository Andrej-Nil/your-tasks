<?php

$db = \classes\App::get(\classes\Db::class);

$validator = \classes\App::get(\classes\Validator::class);
$fillable = ['title', 'description', 'deadline', 'id'];
$data = load($fillable);
$task = $db->query("SELECT * FROM tasks WHERE id=? LIMIT 1", [$data['id']])->findOrFail();


$validation = $validator->validate($data, [
    "title" => [
        'required' => true,
        'min' => 5,
        'max' => 190
    ],
    "deadline" => [
        'required' => false,
        'relevance' => $task['date_creating']
    ]
]);

$values = [
    $data['title'],
    $data['description'],
    $data['deadline'],
    $data['id'],

];

if (!$validation->hasErrors()) {

    $res = $db->query(
        "UPDATE tasks SET title=?, description=?, deadline=? WHERE id=?",
        $values
    );

    if ($res) {
        $_SESSION['success'] = "Изменения успешно сохранены";
    } else {
        $_SESSION['error'] = "Произошла ошибка, изменения были не сохранены";
    }

    redirect("/tasks/show?id={$task['id']}");
} else {
    require_once VIEWS . '/task/edit.tpl.php';
}




