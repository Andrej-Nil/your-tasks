<div class="task-card <?= getTaskStatusCls($task) ?>">
    <a href="task/show?id=<?=$task['id'] ?>" class="task-card__link">
        <p class="task-card__data">от <?= $task['date_creating'] ?></p>
        <p class="task-card__title"><?= h($task['title']) ?></p>
        <?php if ($task['description']): ?>
            <p class="task-card__desc"><?= h($task['description']) ?></p>
        <?php endif; ?>
        <div class="task-card__info">
            <div class="task-card-row">
                  <span class="task-card-row__label">
                        Статус
                  </span>
                <span class="task-card-row__value">
                      <?= getTaskStatusWord($task['status']) ?>
                </span>
            </div>
            <?php if ($task['date_ending']): ?>
                <div class="task-card-row">
                    <span class="task-card-row__label">
                          Дата выволнения
                    </span>
                    <span class="task-card-row__value">
                         <?= $task['date_ending'] ?>
                    </span>
                </div>
            <?php endif; ?>

            <div class="task-card-row">

                  <span class="task-card-row__label">
                       Дата сдачи
                  </span>
                <span class="task-card-row__value">
                     <?= $task['deadline'] ?? 'Не указано' ?>
                </span>
            </div>
            <?php if (!$task['date_ending'] && $task['deadline']): ?>
                <div class="task-card-row">
                    <span class="task-card-row__label">
                         Дней до сдачи
                    </span>
                    <span class="task-card-row__value">
                        <?= timeLeft($task['deadline']) ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </a>
        <div class="task-card__panel">
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