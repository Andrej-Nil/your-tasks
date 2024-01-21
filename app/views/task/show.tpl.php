<?php require VIEWS . '/incs/header.tpl.php' ?>

    <div class="wrapper container">


        <div class="content">

            <div class="main">
               <div data-task="<?= $task['id'] ?>" class="task <?= getTaskStatusCls($task) ?>">
                 <h1 class="task__title"><?= h($task['title'])?></h1>
                    <p class="task__date">от <?= $task['date_creating'] ?></p>

                   <div class="task__inner">
                     <div class="task__content">

                      <?php if ($task['description']): ?>
                         <p class="task__desc"><?= h($task['description']) ?></p>
                      <?php endif; ?>
                         <div class="task-info">
                              <div class="task-info-row">
                                  <span class="task-info-row__label">Статус:</span>
                                  <span data-status-text class="task-info-row__value"><?= getTaskStatusWord($task['status']) ?></span>
                              </div>
                             <?php if ($task['date_ending']): ?>
                             <div class="task-info-row">
                                 <span class="task-info-row__label">Дата выволнения:</span>
                                 <span class="task-info-row__value"><?= $task['date_ending'] ?></span>
                             </div>
                             <?php endif; ?>

                             <div class="task-info-row">
                                 <span class="task-info-row__label">Дата сдачи:</span>
                                 <span class="task-info-row__value"><?= $task['deadline'] ?? 'Не указано' ?></span>
                             </div>

                              <?php if (!$task['date_ending'] && $task['deadline']): ?>
                             <div class="task-info-row">
                                  <span class="task-info-row__label">Дней до сдачи:</span>
                                  <span class="task-info-row__value"><?= timeLeft($task['deadline'])  ?></span>
                             </div>
                              <?php endif; ?>
                         </div>
                     </div>
                     <div data-controls class="task__controls">
                         <?php if($task['status'] === 'active'): ?>
                           <button data-action="pause" class="btn btn--icon">
                             <img data-icon class="btn__icon" src="<?= IMG ?>/icons/pause.svg" alt="">
                           </button>
                         <?php elseif($task['status'] === 'pause'): ?>
                           <button data-action="activate" class="btn btn--icon">
                             <img data-icon class="btn__icon" src="<?= IMG ?>/icons/play.svg" alt="">
                           </button>
                         <?php endif ?>

                         <?php if($task['status'] !== 'completed' && $task['status'] !== 'cancelled'): ?>
                           <button data-action="complete" class="btn btn--icon">
                             <img class="btn__icon" src="<?= IMG ?>/icons/check.svg" alt="">
                           </button>
                         <?php endif ?>

                         <a href="/tasks/edit?id=<?=$task['id']?>" class="btn btn--icon">
                           <img class="btn__icon" src="<?= IMG ?>/icons/settings.svg" alt="">
                         </a>
                     </div>

                   </div>
                   <div class="task__bottom">
                       <form action="/tasks" method="post">
                           <input type="hidden" name="id" value="<?=$task['id'] ?>">
                           <input type="hidden" name="_method" value="delete">
                           <button type="submit" class="btn btn--error">Удалить</button>
                       </form>
                     <?php if($task['status'] === 'cancelled'): ?>
                        <button data-action="resume" class="btn btn--action">
                          Вернуть
                        </button>
                       <?php elseif($task['status'] !== 'completed' ): ?>
                       <button data-action="cancel" class="btn btn--cancel">
                         Отмена
                       </button>
                     <?php endif ?>
                   </div>
               </div>
            </div>
            <div class="sidebar">
                sidebar
            </div>
        </div>
    </div>

<?php require  VIEWS . '/incs/footer.tpl.php' ?>