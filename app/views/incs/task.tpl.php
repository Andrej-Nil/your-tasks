<div class="task-card <?= getTaskStatusCls($task) ?>">
    <a href="task/show?id=<?=$task['id']?>" class="task-card__link">
        <p class="task-card__data">от <?= $task['date'] ?></p>
        <p class="task-card__title"><?= $task['title'] ?></p>
        <p class="task-card__desc"><?= $task['description'] ?></p>
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
            <? endif; ?>

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
            <? endif; ?>

        </div>
        <div class="task-card__panel">
            <button class="task-card-btn">
                <img class="task-card-btn__icon" src="../assets/img/icons/pause.svg"/>
            </button>
            <button class="task-card-btn">
                <img class="task-card-btn__icon" src="../assets/img/icons/settings.svg"/>
            </button>
            <button class="task-card-btn">
                <img class="task-card-btn__icon" src="../assets/img/icons/delete.svg"/>
            </button>
            <button class="task-card-btn">
                <img class="task-card-btn__icon" src="../assets/img/icons/check.svg"/>
            </button>
        </div>
    </a>
</div>