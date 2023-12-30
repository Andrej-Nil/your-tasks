<div data-task="<?= $task['id'] ?>" class="task-card <?= getTaskStatusCls($task) ?>">
        <p class="task-card__data">от <?= $task['date_creating'] ?></p>
        <p class="task-card__title">
            <a href="/tasks/show?id=<?= $task['id'] ?>"> <?= h($task['title']) ?> </a>
        </p>
        <?php if ($task['description']): ?>
            <p class="task-card__desc"><?= h($task['description']) ?></p>
        <?php endif; ?>
        <div class="task-card__info">
            <div class="task-card-row">
                  <span class="task-card-row__label">
                        Статус
                  </span>
                <span data-status-text class="task-card-row__value">
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
        <div class="task-card__panel">
            <?php if($task['status'] === 'progress'): ?>
            <button data-action="progress" class="btn btn--icon">
                <img data-icon-progress class="btn__icon" src="<?= IMG ?>/icons/pause.svg" alt="">
            </button>
            <?php elseif($task['status'] === 'pause'): ?>
                <button data-action="progress" class="btn btn--icon">
                    <img data-icon-progress class="btn__icon" src="<?= IMG ?>/icons/play.svg" alt="">
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