<?php
$auth = \classes\App::get(\classes\Auth::class);
$auth->logout();
redirect(LOGIN_PAGE);