<?php

namespace View;


use Controller\Controller;
use Controller\DataBaseController;

class View
{
    private $controller;
    private $errors;
    private $dataBaseController;

    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
        $this->dataBaseController = new DataBaseController();
    }

    public function render($page, $errors)
    {
        $this->errors = $errors;
        require_once DIR_VIEWS . $page . '.php';
    }

    public function getData($data)
    {
        return $this->dataBaseController->getData(6, $data);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}