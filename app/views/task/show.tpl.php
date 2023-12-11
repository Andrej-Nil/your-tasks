<?php require VIEWS . '/incs/header.tpl.php' ?>

    <div class="wrapper container">


        <div class="content">

            <main class="main">
               <div class="task">
                   <h1 class="task__title"><?= $task['title'] ?></h1>
                   <p class="task__desc"><?= $task['description'] ?></p>
                   <div class="task__info">

                   </div>

                   <div class="task__bottom">
                       <a href="!#" class="btn btn--action">Пауза</a>
                       <a href="!#" class="btn btn--action">Выполнена</a>
                       <a href="!#" class="btn btn--action">Редостировать</a>
                       <a href="!#" class="btn btn--action">Удалить</a>
                       <a href="!#" class="btn btn--action">Отменить</a>

                   </div>
               </div>
            </main>
            <div class="sidebar">
                sidebar
            </div>
        </div>
    </div>

<?php require  VIEWS . '/incs/footer.tpl.php' ?>