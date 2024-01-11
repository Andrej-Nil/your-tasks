<div id="noteStore" class="note-store">
  <form id="noteMaker" action="" method="post" class="note-marker">
    <div class="note-marker__top">
      <div data-messages class="note-marker__message">

      </div>
      <button type="button" data-maker-close class="note-marker__close btn btn--icon">
        <img src="<?= IMG . '/icons/close.svg' ?>" class="btn__icon" alt="">
      </button>
    </div>

    <div  class="note-marker__body">
      <textarea data-maker-input class="note-marker__input input" name="text" rows="6" placeholder="Текст заметки"></textarea>
      <div class="note-marker__controls">
        <div class="note-marker__colors">
          <div class="checkbox">
            <label clas="checkbox__label">
              <input data-maker-color type="radio" class="checkbox__input" name="color" value="white" checked>
              <span class="checkbox__fake checkbox-color">
                 <span class="checkbox-color__paint white"></span>
              </span>
            </label>
          </div>
          <div class="checkbox">
            <label clas="checkbox__label">
              <input data-maker-radio type="radio" class="checkbox__input" name="color" value="yellow">
              <span class="checkbox__fake checkbox-color">
                <span class="checkbox-color__paint yellow"></span>
              </span>
            </label>
          </div>
          <div class="checkbox">
            <label clas="checkbox__label">
              <input data-maker-color type="radio" class="checkbox__input" name="color" value="green">
              <span class="checkbox__fake checkbox-color">
                <span class="checkbox-color__paint green"></span>
              </span>
            </label>
          </div>
          <div class="checkbox">
            <label clas="checkbox__label">
              <input data-maker-color type="radio" class="checkbox__input" name="color" value="blue">
              <span class="checkbox__fake checkbox-color">
                <span class="checkbox-color__paint blue"></span>
              </span>
            </label>
          </div>
          <div class="checkbox">
            <label clas="checkbox__label">
              <input data-maker-color type="radio" class="checkbox__input" name="color" value="red">
              <span class="checkbox__fake checkbox-color">
                <span class="checkbox-color__paint red"></span>
              </span>
            </label>
          </div>
        </div>
        <button class="note-marker__btn btn btn--action">Создать</button>
      </div>
    </div>
  </form>
    <p class="note-store__title">Быстрые заметки</p>

  <div class="note-store__controls">
    <button data-delete-all class="note-store__btn btn btn--error">Очистить</button>
    <button data-maker-open class="note-store__btn btn btn--action">Добавить</button>
  </div>

<!--    <form class="note-create" method="post">-->
<!--      <input type="hidden" name="_method" value="PUT">-->
<!--      <input class="note-create__input input" placeholder="Текст заметки"/>-->
<!--      <button data-action="activate" class="note-create__btn btn btn--icon btn--action">-->
<!--        +-->
<!--      </button>-->
<!--    </form>-->

  <div id="noteList" class="note-list">

      <?php foreach ($notes as $note): ?>
          <div data-note="<?= $note['id'] ?>" class="note-card <?= $note['color'] ?>">
              <div class="note-card__text">
                  <?= $note['text'] ?>
              </div>
              <button class="note-card__btn btn btn--icon">
                  <img src="<?= IMG . '/icons/trash.svg' ?>" alt="" class="btn__icon">
              </button>
          </div>
      <?php endforeach; ?>

  </div>


</div>

