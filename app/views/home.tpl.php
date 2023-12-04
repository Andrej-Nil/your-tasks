<?php require  '../app/views/incs/header.tpl.php' ?>

      <div class="wrapper container">
          <h1 class="main-title">Активные задачи</h1>

          <div class="content">

              <main class="main">
                <div class="task-list">
                    <div class="task-card">
                        <p class="task-card__data">от 23.12.2023</p>
                        <p class="task-card__title">Lorem ipsum dolor sit amet.</p>
                        <p class="task-card__desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, beatae expedita hic laudantium provident quaerat repellat sapiente sunt totam velit?</p>
                        <div class="task-card__info">
                            <div class="task-card-row">
                                <span class="task-card-row__label">
                                    Срок
                                </span>
                                <span class="task-card-row__value">
                                    до 30.12.2023
                                </span>
                            </div>
                            <div class="task-card-row">
                                <span class="task-card-row__label">
                                    Срок истекает
                                </span>
                                <span class="task-card-row__value">
                                   через 23 дня
                                </span>
                            </div>
                        </div>
                            <div class="task-card__panel">
                                <button class="task-card-btn">
                                    <img class="task-card-btn__icon" src="../assets/img/icons/pause.svg" />
                                </button>
                                <button class="task-card-btn">
                                    <img class="task-card-btn__icon" src="../assets/img/icons/settings.svg" />
                                </button>
                                <button class="task-card-btn">
                                    <img class="task-card-btn__icon" src="../assets/img/icons/delete.svg" />
                                </button>
                                <button class="task-card-btn">
                                    <img class="task-card-btn__icon" src="../assets/img/icons/check.svg" />
                                </button>
                        </div>

                    </div>
                </div>
              </main>
              <div class="sidebar">
                sidebar
              </div>
          </div>
      </div>

<?php require  '../app/views/incs/footer.tpl.php' ?>