<?php require VIEWS . '/incs/header.tpl.php' ?>

      <div class="wrapper container dn">
          <h1 class="main-title">Активные задачи</h1>

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
                    <p class="message-block__text">У вас нет активных задач.</p>
                    <div class="message-block__controls">
                      <a href="tasks/create" class="btn btn--action">Создать</a>
                      <a href="tasks" class="btn btn--success">Все задачи</a>
                    </div>
                  </div>

                <?php endif; ?>



                <?php if(count($links) > 1): ?>
                  <?php require VIEWS . '/incs/pagination.tpl.php' ?>
                <?php endif; ?>

              </div>
              <div class="sidebar">
                <?php require VIEWS . '/incs/notes.tpl.php' ?>
              </div>
          </div>
      </div>
<?php require  VIEWS . '/incs/footer.tpl.php' ?>