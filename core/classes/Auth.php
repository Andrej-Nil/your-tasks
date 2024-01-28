<?php

namespace classes;

class Auth
{

    public function __construct()
    {

    }

    public function set($user)
    {
        $_SESSION['user'] = $this->getUserData($user);
    }

    public function get(){
        return $_SESSION['user'];
    }
    public function logout(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }

    }
    public function check(){
        return isset($_SESSION['user']);
    }

    private function getUserData($user) {
        $data = [];

        foreach ($user as $key => $value) {
            if($key !== 'password'){
                $data[$key] = $value;
            }
        }
        return $data;
    }
}