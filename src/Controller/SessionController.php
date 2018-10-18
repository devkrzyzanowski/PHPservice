<?php

namespace src\Controller;

class SessionController
{
    public function __construct()
    {
    }

    public function logout()
    {
        $this->sessionRemove();
    }

    public function login()
    {
        $this->sessionCreate();
    }

    private function sessionCreate()
    {

    }

    private function sessionRemove()
    {
        $_SESSION['logged'] = 0;
        session_destroy();
    }

    public function checkSession()
    {
        ($_SESSION['logged'] == 1 && time() - $_SESSION['time'] > 300) ? $this->sessionRemove() : null;
    }

}