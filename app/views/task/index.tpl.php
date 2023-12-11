<?php require VIEWS . '/incs/header.tpl.php' ?>

    <div class="wrapper container">
        <h1 class="main-title">Список задач</h1>

        <div class="content">

            <main class="main">
                <div class="task-list">
                    <?php foreach ($tasks as $task): ?>
                        <?php require VIEWS . '/incs/task.tpl.php' ?>
                    <?php endforeach; ?>
                </div>
            </main>
            <div class="sidebar">
                sidebar
            </div>
        </div>
    </div>

<?php require  VIEWS . '/incs/footer.tpl.php' ?>