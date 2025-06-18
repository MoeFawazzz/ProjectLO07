<?php
require_once 'app/controller/config.php';

abstract class Model {
    public static $pdo;

    public static function init() {
        try {
            $hostname = Config::$hostname;
            $database = Config::$database;
            $login    = Config::$login;
            $password = Config::$password;

            $pdo = new PDO("mysql:host=$hostname;dbname=$database", $login, $password,
                           [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo = $pdo;
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            die();
        }
    }
}

Model::init();
