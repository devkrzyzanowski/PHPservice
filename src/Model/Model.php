<?php

namespace Model;


use PDO;

class Model
{
    private $viewsArray = array();

    public function __construct()
    {
        $this->viewsArray = ['login', 'register', 'default', 'error'];
    }

    private function open_database_connection()
    {
        $dbHandle = false;
        try {
            $dbHandle = new PDO(DATABASE_DSN, DATABASE_USER, DATABASE_PASSWORD);
            $dbHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $dbHandle->query('SET NAMES utf8');
//            $dbHandle->query('SET CHARACTER_SET utf8_unicode_ci');
        } catch (\Exception $exc) {
            echo "Not connected" . $exc->getMessage();
        }
        return $dbHandle;
    }

    private function close_database_connection($dbHandle)
    {
        $dbHandle = null;
    }

    public function getViewsArray()
    {
        return $this->viewsArray;
    }

    public function addError($data)
    {
        $userAgent = filter_var($_SERVER['HTTP_USER_AGENT'], FILTER_SANITIZE_STRING);
        $uri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_STRING);
        $dbHandle = $this->open_database_connection();
        $stmt = $dbHandle->prepare("INSERT INTO errors (date, userAgent, uri) VALUES (:data, :userAgent, :uri)");
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':userAgent', $userAgent);
        $stmt->bindParam(':uri', $uri);
        $stmt->execute();
        $this->close_database_connection($dbHandle);
    }

    public function getDataByUserId($id, $data)
    {
        $check = false;
        $query = ("SELECT * FROM users WHERE id = " . $id);
        $row = null;

        (isset($id) && isset($data)) ? $check = true : null;
        if ($check) {
            $dbHandle = $this->open_database_connection();
            $dbHandle->exec('SET NAMES utf8');
            $result = $dbHandle->query($query);
            foreach ($result as $row) ;
            $this->close_database_connection($dbHandle);
        }
        return $row[$data];
    }

    public function login($email, $password)
    {
        $check = false;
        $id = null;
        $query = ('SELECT * FROM users WHERE email = \'" . $email . "\' AND password = \'" . $password . "\'');
        (isset($email) && isset($password)) ? $check = true : null;
        if ($check) {
            $dbHandle = $this->open_database_connection();
            $dbHandle->exec('SET NAMES utf8');
            $result = $dbHandle->query($query);
            foreach ($result as $row) {
                var_dump($this->id = $row['id']);
            }
            $this->close_database_connection($dbHandle);
        }

    }

    public function registerUser($firstName, $lastName, $email, $password)
    {
        $dbHandle = $this->open_database_connection();
        $stmt = $dbHandle->prepare("INSERT INTO users (first_name, last_name, password, email) VALUES (:firstName, :lastName, :password, :email)");
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $this->close_database_connection($dbHandle);
    }
}