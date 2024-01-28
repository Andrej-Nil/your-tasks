<div id="messageModule" class="message-module">
  <?php if(isset($error)): ?>
    <div data-message class="message-card error" style="height: 100%">
      <div data-inner class="message-card__inner">
        <div class="message-card__content">
          <div class="message-card__top">
            <div class="message-card__title">Ошибка</div>
            <button type="button" data-delete class="message-card__delete btn btn--icon">
              <img src="/assets/img/icons/close.svg" class="btn__icon" alt="">
            </button>
          </div>
          <p class="message-card__text"><?= $error ?></p>
        </div>
      </div>
    </div>
  <?php endif ?>
<!--    <div class="message-card error">-->
<!--        <div class="message-card__inner">-->
<!--            <div class="message-card__top">-->
<!--                <div class="message-card__title">Ошибка</div>-->
<!--                <button type="button" data-delete class="message-card__delete btn btn--icon">-->
<!--                    <img src="/assets/img/icons/close.svg" class="btn__icon" alt="">-->
<!--                </button>-->
<!--            </div>-->
<!--            <p class="message-card__text">Произошла ошибка вот посмотри пожалуста</p>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="message-card">-->
<!--        <div class="message-card__inner">-->
<!--            <div class="message-card__top">-->
<!--                <div class="message-card__title">Ошибка</div>-->
<!--                <button type="button" data-delete class="message-card__delete btn btn--icon">-->
<!--                    <img src="/assets/img/icons/close.svg" class="btn__icon" alt="">-->
<!--                </button>-->
<!--            </div>-->
<!--            <p class="message-card__text">Произошла ошибка вот посмотри пожалуста</p>-->
<!--        </div>-->
<!--    </div>-->

<!--    <div class="message-card success">-->
<!--        <div class="message-card__inner">-->
<!--            <div class="message-card__top">-->
<!--                <div class="message-card__title">Ошибка</div>-->
<!--                <button type="button" data-delete class="message-card__delete btn btn--icon">-->
<!--                    <img src="/assets/img/icons/close.svg" class="btn__icon" alt="">-->
<!--                </button>-->
<!--            </div>-->
<!--            <p class="message-card__text">Произошла ошибка вот посмотри пожалуста</p>-->
<!--        </div>-->
<!--    </div>-->
</div>



