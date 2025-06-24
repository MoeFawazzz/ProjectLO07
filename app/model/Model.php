<?php
require_once 'app/controller/config.php'; // use correct path to config.php

abstract class Model {
    private static $pdo;

    public static function Init() {
        global $dsn, $username, $password;

        try {
            self::$pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            die();
        }
    }

    public static function getPDO() {
        if (!isset(self::$pdo)) {
            self::Init();
        }
        return self::$pdo;
    }
}
