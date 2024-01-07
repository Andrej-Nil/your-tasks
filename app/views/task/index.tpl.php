<?php require VIEWS . '/incs/header.tpl.php' ?>

    <div class="wrapper container">

        <h1 class="main-title">Список задач</h1>

        <div class="content">

            <div class="main">
              <?php if($tasks): ?>
                <div class="task-list">
                  <?php foreach ($tasks as $task): ?>
                    <?php require VIEWS . '/incs/task.tpl.php' ?>
                  <?php endforeach; ?>
                </div>

              <?php else: ?>
                <div class="message-block">
                  <p class="message-block__text">У вас нет задач.</p>
                  <div class="message-block__controls">
                    <a href="tasks/create" class="btn btn--action">Создать</a>
                    <a href="tasks" class="btn btn--success">Все задачи</a>
                  </div>

                </div>

              <?php endif; ?>



              <?php require VIEWS . '/incs/pagination.tpl.php' ?>
            </div>

            <div class="sidebar">
                sidebar
            </div>
        </div>
    </div>

<?php require  VIEWS . '/incs/footer.tpl.php' ?>