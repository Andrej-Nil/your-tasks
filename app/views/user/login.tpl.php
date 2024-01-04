<?php require VIEWS . '/incs/header.tpl.php' ?>

    <div class="wrapper small-container">
        <h1 class="main-title">Вход</h1>
        <div class="content">

            <div class="main">
                <form class="form" action="login" method="post">
                  <div class="form__controls">
                    <div class="control">
                      <label class="control__label" for="email">Почта</label>
                      <input id="email" type="email" name="email" class="control__input input" autofocus required>
                      <span class="control__error">Почта или пароль не совподают</span>
                    </div>

                    <div class="control">
                      <label class="control__label" for="password">Пароль</label>
                      <input id="password" type="password" name="password" class="control__input input" required>
                    </div>
                  </div>

                  <div class="form__bottom">
                    <button type="submit" class="form-btn btn btn--action">Вход</button>
                    <div class="form__row">
                      <a href="register" class="form__link">Нет аккаунта?</a>
                      <a href="/" class="form__lost">Забыли пароль?</a>
                    </div>

                  </div>

                </form>
            </main>
        </div>

    </div>

<?php require  VIEWS . '/incs/footer.tpl.php' ?>