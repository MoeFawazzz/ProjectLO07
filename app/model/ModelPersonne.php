<?php
require_once 'app/model/Model.php';

class ModelPersonne extends Model {

    public static function getByLoginPassword($login, $password) {
        try {
            $pdo = self::$pdo;
            $sql = "SELECT * FROM personne WHERE login = :login AND password = :password";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['login' => $login, 'password' => $password]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
}
