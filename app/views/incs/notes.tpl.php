<div id="noteStore" class="note-store">
  <div id="noteMaker" class="note-marker">
    <button data-maker-close class="note-marker__close btn btn--icon">
      <img src="<?= IMG . '/icons/close.svg' ?>" class="btn__icon" alt="">
    </button>
    <form action="post">
      <textarea data-maker-input class="note-marker__input input" rows="6" placeholder="Текст заметки"></textarea>
      <div class="note-marker__controls">
        <div class="note-marker__colors">
          <div class="checkbox">
            <label clas="checkbox__label">
              <input type="radio" class="checkbox__input" name="color" value="0" checked>
              <span class="checkbox__fake checkbox-color">
                 <span class="checkbox-color__paint white"></span>
              </span>
            </label>
          </div>
          <div class="checkbox">
            <label clas="checkbox__label">
              <input type="radio" class="checkbox__input" name="color" value="0">
              <span class="checkbox__fake checkbox-color">
                <span class="checkbox-color__paint yellow"></span>
              </span>
            </label>
          </div>

          <div class="checkbox">
            <label clas="checkbox__label">
              <input type="radio" class="checkbox__input" name="color" value="0">
              <span class="checkbox__fake checkbox-color">
                <span class="checkbox-color__paint green"></span>
              </span>
            </label>
          </div>

          <div class="checkbox">
            <label clas="checkbox__label">
              <input type="radio" class="checkbox__input" name="color" value="0">
              <span class="checkbox__fake checkbox-color">
                <span class="checkbox-color__paint blue"></span>
              </span>
            </label>
          </div>

          <div class="checkbox">
            <label clas="checkbox__label">
              <input type="radio" class="checkbox__input" name="color" value="0">
              <span class="checkbox__fake checkbox-color">
                <span class="checkbox-color__paint red"></span>
              </span>
            </label>
          </div>
        </div>
        <button class="note-marker__btn btn btn--action">Создать</button>
      </div>
    </form>
  </div>
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
    <div data-note class="note-card">
      <div class="note-card__text">
        Lorem ipsum dolor.
      </div>
      <button class="note-card__btn btn btn--icon">
        <img src="<?= IMG . '/icons/trash.svg' ?>" alt="" class="btn__icon">
      </button>
    </div>
  </div>


</div>

