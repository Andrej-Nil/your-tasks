<?php

namespace middleware;
class Auth
{
    public function handle()
    {
        if (!check_auth()) {
            redirect(WELCOME_PAGE);
        }
    }
}