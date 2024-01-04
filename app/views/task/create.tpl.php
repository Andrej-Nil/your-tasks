<?php require VIEWS . '/incs/header.tpl.php' ?>
    <div class="wrapper small-container">
        <h1 class="main-title">Новая задача</h1>
        <div class="content">

            <div class="main">
                <form class="form" action="/tasks" method="post">
                    <div class="form__controls">
                        <div class="control">
                            <label class="control__label" for="title">Название</label>
                            <input id="title" type="text" name="title" class="control__input input" value="<?=  old('title') ?>" autofocus>
                            <?= isset($validation) ? $validation->listErrors('title') : '' ?>
                        </div>

                        <div class="control">
                            <label class="control__label" for="description">Описание задачи</label>
                            <textarea class="control__input input" name="description" id="description" rows="5"><?= old('description')  ?></textarea>
                        </div>

                      <div class="control">
                        <label class="control__label" for="deadline">Дата сдачи</label>
                        <input id="deadline" type="date" name="deadline" class="control__input input" value="<?= old('deadline') ?>">
                          <?= isset($validation) ? $validation->listErrors('deadline') : '' ?>
                      </div>
                    </div>

                    <div class="form__bottom">
                        <button type="submit" class="form-btn btn btn--action">Создать</button>

                    </div>

                </form>
            </div>
        </div>

    </div>

<?php require  VIEWS . '/incs/footer.tpl.php' ?>