<?php

namespace Controller;


use Model\Model;

class DataBaseController
{
    private $model;
    public function __construct()
    {
        $this->model = new Model();
    }

    public function getData($id, $data){
        return $this->model->getDataByUserId($id, $data);
    }

}