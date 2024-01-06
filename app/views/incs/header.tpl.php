<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= PATH ?>/">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?= $title ?></title>
</head>
<body>

<div class="app">
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <a href="/" class="header__logo logo">
                    <img src="<?=IMG ?>/logo.svg" alt="" class="logo__img">
                </a>

              <?php if(check_auth()): ?>
                <nav class="header__nav nav">
                    <a href="tasks" class="nav__item">Задачи</a>
                    <a href="tasks/create" class="nav__item">Добавить</a>
<!--                    <a href="/" class="nav__item">Настройки</a>-->
                </nav>
              <?php endif; ?>

                <div class="header__menu menu nav">

                    <?php if(check_auth()): ?>
                        <a  class="menu__item nav__item"><?= $_SESSION['user']['name'] ?></a>
                        <a href="logout" class="menu__item nav__item">Выход</a>
                    <?php else: ?>
                        <a href="login" class="menu__item nav__item">Вход</a>
                        <a href="register" class="menu__item nav__item">Регистрация</a>

                    <?php endif; ?>
<!--                    <a href="/" class="menu__item nav__item">Андрей</a>-->
<!--                    <a href="/" class="menu__item nav__item">Выход</a>-->

                </div>
            </div>
        </div>
    </header>
    <?php getAlerts(); ?>
