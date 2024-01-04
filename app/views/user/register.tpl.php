<?php require VIEWS . '/incs/header.tpl.php' ?>

    <div class="wrapper small-container">
        <h1 class="main-title">Регистрация</h1>
        <div class="content">

            <div class="main">
                <form class="form" action="register" method="post">
                    <div class="form__controls">
                        <div class="control">
                            <label class="control__label" for="name">Имя</label>
                            <input id="name" type="text" name="name" class="control__input input" autofocus required>
                            <span class="control__error">Почта или пароль не совподают</span>
                        </div>
                        <div class="control">
                            <label class="control__label" for="email">Почта</label>
                            <input id="email" type="email" name="email" class="control__input input" required>
                        </div>

                        <div class="control">
                            <label class="control__label" for="password">Пароль</label>
                            <input id="password" type="password" name="password" class="control__input input" required>
                        </div>
                        <div class="control">
                            <label class="control__label" for="confirm">Подтверждение пароля</label>
                            <input id="confirm" type="password" name="confirm" class="control__input input" required>
                        </div>
                    </div>

                    <div class="form__bottom">

                        <div class="form__row">
                            <a href="login" class="form__link">Есть аккаунт?</a>
                            <button type="submit" class="form-btn btn btn--action">Регистрация</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>

<?php require  VIEWS . '/incs/footer.tpl.php' ?>