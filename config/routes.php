<?php

const MIDDLEWARE = [
    'auth' => \middleware\Auth::class,
    'guest' => \middleware\Guest::class
];
$router->get('welcome', 'welcome.php')->only('guest');
$router->get('', 'index.php')->only('auth');

// Tasks routes
$router->get('tasks/create', 'task/create.php')->only('auth');
$router->post('tasks', 'task/store.php')->only('auth');
$router->get('tasks', 'task/index.php')->only('auth');
$router->get('tasks/show', 'task/show.php')->only('auth');
$router->delete('tasks', 'task/destroy.php')->only('auth');
$router->get('tasks/edit', 'task/edit.php')->only('auth');
$router->put('tasks/update', 'task/update.php')->only('auth');

// Tasks routes api
$router->patch('api/tasks/activate','task/api.activate.php' )->only('auth');
$router->patch('api/tasks/pause','task/api.pause.php' )->only('auth');
$router->patch('api/tasks/complete','task/api.complete.php' )->only('auth');
$router->patch('api/tasks/cancel','task/api.cancel.php' )->only('auth');
$router->patch('api/tasks/resume','task/api.resume.php' )->only('auth');

// ------------------------------------------

//note routes api
$router->post('api/notes/store', 'note/api.store.php')->only('auth');
$router->delete('api/notes/delete', 'note/api.destroy.php')->only('auth');
$router->delete('api/notes/delete/all', 'note/api.destroy-all.php')->only('auth');


// ------------------------------------------
// user
$router->get('user/show', 'user/show.php')->only('auth');

$router->get('register', 'user/register.php')->only('guest');
$router->post('register', 'user/store.php')->only('guest');

$router->get('login', 'user/login.php')->only('guest');
$router->post('login', 'user/login.php')->only('guest');
$router->get('logout', 'user/logout.php')->only('auth');






//dump($router->routes);
//$routes = [
//    '' => 'show.php',
//    'login' => '/user/login.php',
//    'register' => '/user/register.php',
//
//    'task' => '/task/show.php',
//    'task/create' => '/task/create.php',
////    'task/store' => '/task/create.php',
//    'task/show' => '/task/show.php',
//];