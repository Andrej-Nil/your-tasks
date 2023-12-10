<?php require VIEWS . '/incs/header.tpl.php' ?>

    <div class="wrapper small-container">
        <h1 class="main-title">Новая задача</h1>
        <div class="content">

            <main class="main">
                <form class="form" action="task/store" method="post">
                    <div class="form__controls">
                        <div class="control">
                            <label class="control__label" for="title">Название</label>
                            <input id="title" type="text" name="title" class="control__input input" autofocus required>
                            <span class="control__error">Почта или пароль не совподают</span>
                        </div>

                        <div class="control">
                            <label class="control__label" for="description">Описание задачи</label>
                            <textarea class="control__input input" name="description" id="description" rows="5"></textarea>
                        </div>

                      <div class="control">
                        <label class="control__label" for="date">Дата сдачи</label>
                        <input id="date" type="date" class="control__input input">
                      </div>
                    </div>

                    <div class="form__bottom">
                        <button type="submit" class="form-btn btn btn--action">Создать</button>
                    </div>

                </form>
            </main>
        </div>

    </div>

<?php require  VIEWS . '/incs/footer.tpl.php' ?>