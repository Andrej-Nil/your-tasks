
<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <div class="footer__content">
                <a href="/" class="footer__logo logo">
                    <img src="../assets/img/logo.svg" alt="Your Tasks" class="logo__img">
                </a>

                <nav class="footer__nav nav">
                    <a href="/" class="nav__item">О Проекте</a>
                    <a href="/" class="nav__item">Помощь</a>
                </nav>
            </div>

            <div class="footer__bottom">
                <div class="copyright">
                    <p class="copyright__text">
                        © 2023-2023 <a href="https://vk.com/andrejnill" class="copyright__author">AndrejNill</a>
                    </p>
                </div>

                <div class="social-list">
                    <a href="https://t.me/AndrejNill" target="_blank" class="social">
                        <img class="social__img" src="../assets/img/icons/telegram.svg" alt="telegram"/>
                    </a>
                    <a href="https://wa.me/79041638785" target="_blank" class="social">
                        <img class="social__img" src="../assets/img/icons/whatsapp.svg" alt="whatsapp"/>
                    </a>
                    <a href="https://vk.com/andrejnill" target="_blank" class="social">
                        <img class="social__img" src="../assets/img/icons/vk.svg" alt="vk"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php if($auth->check()):?>
<?php require_once VIEWS . '/incs/mobile_menu.tpl.php'?>
<?php endif; ?>
<?php require_once VIEWS . '/incs/message_module.tpl.php'?>
<!--<button id="add" class="btn btn--error" style="width: 300px">add</button>-->
</div>

<script src="../assets/js/main.js"></script>
</body>
</html>