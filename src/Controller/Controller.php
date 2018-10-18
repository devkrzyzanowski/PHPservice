<?php

namespace Controller;

use Model\Model;
use View\View;
use src\Controller\SessionController;

class Controller
{
    private $model;
    private $view;
    private $errors;
    private $sessionController;

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View($this);
        $this->sessionController = new SessionController();
        $this->errors = array();
        $this->loadAction();
        $this->loadPage();
        var_dump($this->model->login('test4', 'test3'));
    }

    private function checkRegister()
    {
        $filter_first_name = null;
        $filter_last_name = null;
        $filter_email = null;
        $filter_password = null;
        $filter_confirm_password = null;
        if ($this->available_post()) {
            (isset($_POST['first_name']) && !empty($_POST['first_name'])) ? $filter_first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING) : $this->addError("Błędne lub niepodane imię!");
            (isset($_POST['last_name']) && !empty($_POST['last_name'])) ? $filter_last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING) : $this->addError("Błędne lub niepodane nazwisko!");
            (isset($_POST['email']) && !empty($_POST['email'])) ? $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING) : $this->addError("Błędy lub niepodany email!");
            (isset($_POST['password']) && !empty($_POST['password'])) ? $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING) : $this->addError("Błędne lub niepodane hasło!");
            (isset($_POST['password_confirmation']) && !empty($_POST['password_confirmation'])) ? $filter_confirm_password = filter_var($_POST['password_confirmation'], FILTER_SANITIZE_STRING) : $this->addError("Błędne lub niepodane potwierdzenie hasła!");
            (empty($this->errors)) ? $this->register($filter_first_name, $filter_last_name, $filter_email, $filter_password, $filter_confirm_password) : $this->addError("Popraw błędy!");
        } else {
            array_push($this->errors, "Błąd POST!");
        }
    }

    private function register($f_first_name, $f_last_name, $f_email, $f_password, $f_confirm_password)
    {
        $hash_f_password = null;
        (!strcasecmp($f_password, $f_confirm_password) == 0) ? $this->addError("Hasła nie są takie same!") : $hash_f_password = hash('sha256', $f_password);
        if (empty($this->errors) and !empty($hash_f_password)) {
            $this->model->registerUser($f_first_name, $f_last_name, $f_email, $hash_f_password);
        } else {
            $this->addError("Błąd rejestracji!");
        }
    }

    private function loadPage()
    {
        $page = false;
        if ($this->available_page()) {
            foreach ($this->model->getViewsArray() as $value) {
                ($this->get_page() == $value) ?: $page = true;
            }
        }
        ($page) ? $this->view->render($this->get_page(), $this->errors) : $this->view->render('login', $this->errors);
    }

    private function addError($data)
    {
        $this->model->addError($data);
        array_push($this->errors, $data);
    }

    private function loadAction()
    {
        if ($this->available_action()) {
            switch ($this->get_action()) {
                case 'checkRegister':
                    $this->checkRegister();
                    break;
                case 'checkLogin':
                    $this->checkLogin();
                    break;
                case 'logout':
                    $this->logout();
                    break;
                default :
                    require_once DIR_VIEWS . 'login.php';
                    break;
            }
        }
    }

    public function getErrors()
    {
        if (!empty($this->errors)) {
            return $this->errors;
        } else {
            return "";
        }
    }

    //Czy został przesłany POST
    private function available_post()
    {
        $available_post = false;
        if (isset($_POST)) {
            $available_post = true;
        }
        return $available_post;
    }

    //Czy został przesłany GET
    function available_get()
    {
        $available_get = false;
        if (isset($_GET)) {
            $available_get = true;
        }
        return $available_get;
    }

    //Czy został przesłany GET z zmienną 'action'
    function available_action()
    {
        $available_action = false;
        if ($this->available_get()) {
            if (!empty($_GET['action'])) {
                $available_action = true;
            }
        }
        return $available_action;
    }

    //Czy został przesłany GET z zmienną 'page'
    function available_page()
    {
        $available_page = false;
        if ($this->available_get()) {
            if (!empty($_GET['page'])) {
                $available_page = true;
            }
        }
        return $available_page;
    }

    //Pobierz wartość zmiennej page
    function get_page()
    {
        $data = null;
        if ($this->available_page()) {
            $data = $_GET['page']; //TODO filtracja
        }
        return $data;
    }

    //Pobierz wartość zmiennej action
    function get_action()
    {
        $data = null;
        if ($this->available_action()) {
            $data = $_GET['action']; //TODO filtracja
        }
        return $data;
    }

    //Czy zmienna page w GET ma zmienną równa $name
    function check_available_page($name)
    {
        $page = false;
        if ($this->available_page() == $name) {
            $page = true;
        }
        return $page;
    }

    //Czy zmienna action w GET ma zmienną równa $name
    function check_available_action($name)
    {
        $action = false;
        if ($this->available_action() == $name) {
            $action = true;
        }
        return $action;
    }
}

new Controller();