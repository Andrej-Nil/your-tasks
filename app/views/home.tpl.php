<?php require VIEWS . '/incs/header.tpl.php' ?>

      <div class="wrapper container">
          <h1 class="main-title">Активные задачи</h1>

          <div class="content">

              <div class="main">
                <div class="task-list">

                <?php foreach ($tasks as $task): ?>
                  <?php require VIEWS . '/incs/task.tpl.php' ?>
                <?php endforeach; ?>
                </div>
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