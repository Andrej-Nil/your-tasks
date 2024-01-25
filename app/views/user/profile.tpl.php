<?php require VIEWS . '/incs/header.tpl.php' ?>

<div class="wrapper container">
    <h1 class="main-title">Профиль</h1>
    <div id="tabContainer" class="content">
        <div id="tabContainer" class="main">
            <div class="profile">
                <div data-tab="personal" class="profile__tab  active">
                    <p class="profile__title">Личные данные</p>
                    <div class="profile-block">
                        <div class="profile-info profile-info--row">
                            <div class="profile-info-item">
                                <span class="profile-info-item__label">Имя</span>
                                <span class="profile-info-item__value">AndrejNill</span>
                            </div>

                            <div class="profile-info-item">
                                <span class="profile-info-item__label">Почта</span>
                                <span class="profile-info-item__value">a@a.ru</span>
                            </div>

                        </div>

                    </div>
                    <div class="profile-block">
                        <p class="profile__title">Информация о задачах</p>


                        <div class="profile-block__content">
                            <div class="profile-block__coll">

                                <p class="profile-block__title">Информация в цифрах</p>


                                <div class="profile-info">
                                    <div class="profile-info-item white">
                                        <span class="profile-info-item__label">Всего задач</span>
                                        <span class="profile-info-item__value">999</span>
                                    </div>
                                    <div class="profile-info-item white">
                                        <span class="profile-info-item__label">Активные задачи</span>
                                        <span class="profile-info-item__value">23</span>
                                    </div>

                                    <div class="profile-info-item yellow">
                                        <span class="profile-info-item__label">Приостановленные</span>
                                        <span class="profile-info-item__value">33</span>
                                    </div>

                                    <div class="profile-info-item red">
                                        <span class="profile-info-item__label">Просроченные</span>
                                        <span class="profile-info-item__value">33</span>
                                    </div>

                                    <div class="profile-info-item green">
                                        <span class="profile-info-item__label">Выполненые</span>
                                        <span class="profile-info-item__value">103</span>
                                    </div>


                                    <div class="profile-info-item grey">
                                        <span class="profile-info-item__label">Отмененные</span>
                                        <span class="profile-info-item__value">103</span>
                                    </div>

                                </div>
                            </div>

                            <div class="profile-block__coll">
                                <p class="profile-block__title">Список задач</p>
                                <div class="profile-task-list">
                                    <div class="task-row active">
                                        <a href="" class="task-row__title"> title</a>
                                        <div class="task-row__controls">
                                            <button data-action="pause" class="task-row__btn btn btn--icon">
                                                <img data-icon class="btn__icon" src="<?= IMG ?>/icons/pause.svg"
                                                     alt="">
                                            </button>
                                            <button data-action="activate" class="task-row__btn btn btn--icon">
                                                <img data-icon class="btn__icon" src="<?= IMG ?>/icons/play.svg" alt="">
                                            </button>
                                            <button data-action="complete" class="task-row__btn btn btn--icon">
                                                <img class="btn__icon" src="<?= IMG ?>/icons/check.svg" alt="">
                                            </button>
                                            <!--                      <a href="/tasks/edit?id=" class="task-row__btn btn btn--icon">-->
                                            <!--                        <img class="btn__icon" src="-->
                                            <? //= IMG ?><!--/icons/settings.svg" alt="">-->
                                            <!--                      </a>-->
                                        </div>
                                    </div>
                                    <div class="task-row overdue">
                                        <p class="task-row__title">title</p>
                                        <div class="task-row__controls">
                                            <button data-action="pause" class="task-row__btn btn btn--icon">
                                                <img data-icon class="btn__icon" src="<?= IMG ?>/icons/pause.svg"
                                                     alt="">
                                            </button>
                                            <button data-action="activate" class="task-row__btn btn btn--icon">
                                                <img data-icon class="btn__icon" src="<?= IMG ?>/icons/play.svg" alt="">
                                            </button>
                                            <button data-action="complete" class="task-row__btn btn btn--icon">
                                                <img class="btn__icon" src="<?= IMG ?>/icons/check.svg" alt="">
                                            </button>
                                            <a href="/tasks/edit?id=" class="task-row__btn btn btn--icon">
                                                <img class="btn__icon" src="<?= IMG ?>/icons/settings.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="task-row completed">
                                        <p class="task-row__title">title</p>
                                        <div class="task-row__controls">
                                            <button data-action="pause" class="task-row__btn btn btn--icon">
                                                <img data-icon class="btn__icon" src="<?= IMG ?>/icons/pause.svg"
                                                     alt="">
                                            </button>
                                            <button data-action="activate" class="task-row__btn btn btn--icon">
                                                <img data-icon class="btn__icon" src="<?= IMG ?>/icons/play.svg" alt="">
                                            </button>
                                            <button data-action="complete" class="task-row__btn btn btn--icon">
                                                <img class="btn__icon" src="<?= IMG ?>/icons/check.svg" alt="">
                                            </button>
                                            <a href="/tasks/edit?id=" class="task-row__btn btn btn--icon">
                                                <img class="btn__icon" src="<?= IMG ?>/icons/settings.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="task-row pause">
                                        <p class="task-row__title">title</p>
                                        <div class="task-row__controls">
                                            <button data-action="pause" class="task-row__btn btn btn--icon">
                                                <img data-icon class="btn__icon" src="<?= IMG ?>/icons/pause.svg"
                                                     alt="">
                                            </button>
                                            <button data-action="activate" class="task-row__btn btn btn--icon">
                                                <img data-icon class="btn__icon" src="<?= IMG ?>/icons/play.svg" alt="">
                                            </button>
                                            <button data-action="complete" class="task-row__btn btn btn--icon">
                                                <img class="btn__icon" src="<?= IMG ?>/icons/check.svg" alt="">
                                            </button>
                                            <a href="/tasks/edit?id=" class="task-row__btn btn btn--icon">
                                                <img class="btn__icon" src="<?= IMG ?>/icons/settings.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="task-row cancelled">
                                        <p class="task-row__title">title</p>
                                        <div class="task-row__controls">
                                            <button data-action="pause" class="task-row__btn btn btn--icon">
                                                <img data-icon class="btn__icon" src="<?= IMG ?>/icons/pause.svg"
                                                     alt="">
                                            </button>
                                            <button data-action="activate" class="task-row__btn btn btn--icon">
                                                <img data-icon class="btn__icon" src="<?= IMG ?>/icons/play.svg" alt="">
                                            </button>
                                            <button data-action="complete" class="task-row__btn btn btn--icon">
                                                <img class="btn__icon" src="<?= IMG ?>/icons/check.svg" alt="">
                                            </button>
                                            <a href="/tasks/edit?id=" class="task-row__btn btn btn--icon">
                                                <img class="btn__icon" src="<?= IMG ?>/icons/settings.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-tab="editing" class="profile__tab ">
                    <p class="profile__title">Редактирование</p>
                    <form class="profile__form form" action="/edit" method="post">
                        <div class="form__controls">
                            <div class="control">
                                <label class="control__label" for="title">Изменить имя</label>
                                <input id="title" type="text" name="name" class="control__input input"
                                       value="<?= old('name') ?>" autofocus>
                                <?= isset($validation) ? $validation->listErrors('title') : '' ?>
                            </div>

                            <div class="control">
                                <label class="control__label" for="description">Изменить почту</label>
                                <input id="title" type="text" name="email" class="control__input input"
                                       value="<?= old('email') ?>">
                                <?= isset($validation) ? $validation->listErrors('title') : '' ?>
                            </div>
                        </div>

                        <div class="form__bottom">
                            <button type="submit" class="form-btn btn btn--action">Сохранить</button>

                        </div>

                    </form>


                </div>
                <div data-tab="safety" class="profile__tab ">
                    <p class="profile__title">Безопасность</p>
                    <form class="profile__form form" action="/edit" method="post">
                        <div class="form__controls">
                            <div class="control">
                                <label class="control__label" for="password">Введите текущий пароль</label>
                                <input id="password" type="password" name="password" class="control__input input"
                                       required>
                                <?= isset($validation) ? $validation->listErrors('password') : '' ?>
                            </div>
                            <div class="control">
                                <label class="control__label" for="confirm">Введите новый пароль</label>
                                <input id="confirm" type="password" name="newPassword" class="control__input input"
                                       required>
                                <?= isset($validation) ? $validation->listErrors('confirm') : '' ?>
                            </div>
                            <div class="control">
                                <label class="control__label" for="confirm">Подтвердите нового пароля</label>
                                <input id="confirm" type="password" name="confirm" class="control__input input"
                                       required>
                                <?= isset($validation) ? $validation->listErrors('confirm') : '' ?>
                            </div>
                        </div>

                        <div class="form__bottom">
                            <button type="submit" class="form-btn btn btn--action">Сохранить</button>

                        </div>

                    </form>


                </div>
                <div data-tab="deleteProfile" class="profile__tab">
                    <p class="profile__title">Удаления профиля</p>

                    <div class="profile-block">
                        <p class="profile-block__title bold">Внимание!</p>
                        <p class="profile__text">Удаления профиля несет за собой удаление все данных таких как имя,
                            почта. Так же будут удаленны все ваши задачи и заметки. Профиль не возможно будет
                            востановить! </p>

                    </div>


                    <form class="profile__form form" action="/edit" method="post">
                        <div class="form__bottom">
                            <button type="submit" class="form-btn btn btn--error">Удалить</button>
                        </div>

                    </form>


                </div>

            </div>
        </div>
        <div class="sidebar">
            <div class="sidebar-nav">
                <span data-tab-link="personal" class="sidebar-nav__link active">Личные данные</span>
                <span data-tab-link="editing" class="sidebar-nav__link">Редостировать</span>
                <span data-tab-link="safety" class="sidebar-nav__link">Безопастность</span>
                <span data-tab-link="deleteProfile" class="sidebar-nav__link">Удаление</span>
            </div>
        </div>

    </div>
</div>

<?php
require VIEWS . '/incs/footer.tpl.php' ?>



