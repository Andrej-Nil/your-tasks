<?php require VIEWS . '/incs/header.tpl.php' ?>

    <div class="wrapper container">


        <div class="content">

            <main class="main">
               <div class="task">

                   <h1 class="task__title"><?= $task['title'] ?></h1>
                   <p class="task__date">от <?= $task['date'] ?></p>
                   <div class="task__inner">


                   <div class="task__content">


                       <p class="task__desc"><?= $task['description'] ?></p>
                       <div class="task__info">
                            <div class="task-row">
                                <span class="task-row__label">Статус:</span>
                                <span class="task-row__value"><?= getTaskStatusWord($task['status']) ?></span>
                            </div>
                           <?php if ($task['date_ending']): ?>
                           <div class="task-row">
                               <span class="task-row__label">Дата выволнения:</span>
                               <span class="task-row__value"><?= $task['date_ending'] ?></span>
                           </div>
                           <? endif; ?>

                           <div class="task-row">
                               <span class="task-row__label">Дата сдачи:</span>
                               <span class="task-row__value"><?= $task['deadline'] ?? 'Не указано' ?></span>
                           </div>

                            <?php if (!$task['date_ending'] && $task['deadline']): ?>
                           <div class="task-row">
                                <span class="task-row__label">Дней до сдачи:</span>
                                <span class="task-row__value"><?= timeLeft($task['deadline'])  ?></span>
                           </div>
                            <? endif; ?>
                       </div>
                   </div>
                   <div class="task__controls">
                       <?php if($task['status'] === 'progress'): ?>
                           <a href="!#" class="btn btn--icon">
                               <img class="btn__icon" src="../assets/img/icons/pause.svg" alt="">
                           </a>
                       <?php elseif($task['status'] === 'pause'): ?>
                           <a href="!#" class="btn btn--icon">
                               <img class="btn__icon" src="../assets/img/icons/play.svg" alt="">
                           </a>
                       <?php endif ?>

                       <?php if($task['status'] !== 'completed' && $task['status'] !== 'canceled'): ?>
                           <a href="!#" class="btn btn--icon">
                               <img class="btn__icon" src="../assets/img/icons/check.svg" alt="">
                           </a>
                       <?php endif ?>

                       <a href="!#" class="btn btn--icon">
                           <img class="btn__icon" src="../assets/img/icons/settings.svg" alt="">
                       </a>
                   </div>

                   </div>
                   <div class="task__bottom">
                       <a href="!#" class="btn btn--error">Удалить</a>

                        <?php if($task['status'] === 'cancelled'): ?>
                            <a href="!#" class="btn btn--action">Вернуть</a>
                       <?php elseif ($task['status'] !== 'completed' ): ?>
                            <a href="!#" class="btn btn--cancel">Отменить</a>
                        <?php endif ?>
                   </div>
               </div>
            </main>
            <div class="sidebar">
                sidebar
            </div>
        </div>
    </div>

<?php require  VIEWS . '/incs/footer.tpl.php' ?>