<?php require VIEWS . '/incs/header.tpl.php' ?>


    <div class="wrapper small-container">
        <h1 class="main-title">Редактирование  задачи</h1>
        <div class="content">

            <div class="main">
                <form class="form" action="/tasks/update" method="post">
                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <div class="form__controls">
                        <div class="control">
                            <label class="control__label" for="title">Изменить название</label>


                            <input id="title" type="text" name="title" class="control__input input" value="<?= old('title') ? old('title') : $task['title'] ?>" autofocus>
                            <?= isset($validation) ? $validation->listErrors('title') : '' ?>
                        </div>

                        <div class="control">
                            <label class="control__label" for="description">Изменить описание</label>
                            <textarea class="control__input input" name="description" id="description" rows="5"><?= old('description') ? old('description') : $task['description'] ?></textarea>
                        </div>

                        <div class="control">
                            <label class="control__label" for="deadline">Изменить дату сдачи</label>
                            <input id="deadline" type="date" name="deadline" class="control__input input" value="<?= old('deadline') ? old('deadline') : $task['deadline'] ?>">
                            <?= isset($validation) ? $validation->listErrors('deadline') : '' ?>
                        </div>
                    </div>

                    <div class="form__bottom">
                        <button type="submit" class="form-btn btn btn--action">Сохранить</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

<?php require  VIEWS . '/incs/footer.tpl.php' ?>