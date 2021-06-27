<?php

require '../../../config.php';

class Database {
    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO(URLCONNECTION, USER, PASS);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$instance;
    }

    public static function prepare($sql) {
        return self::getInstance()->prepare($sql);
    }

    public static function lastInsertId(){
        return self::getInstance()->lastInsertId();
    }

    public function testaConexao() {
        try {
            $this->getInstance();
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
}