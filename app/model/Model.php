<?php
require_once 'app/controller/config.php';

abstract class Model {
    public static $pdo;

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
}

Model::Init();
