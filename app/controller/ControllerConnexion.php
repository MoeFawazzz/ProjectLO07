<?php
require_once 'app/model/ModelPersonne.php';

class ControllerConnexion
{

    public static function formConnexion()
    {
        require 'app/view/connexion/formConnexion.php';
    }

    public static function connect()
    {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = ModelPersonne::getByLoginPassword($login, $password);

        if ($user) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['login_id'] = $user['id'];
            $_SESSION['login_nom'] = $user['nom'];
            $_SESSION['login_prenom'] = $user['prenom'];
            $_SESSION['role_responsable'] = $user['role_responsable'];
            $_SESSION['role_examinateur'] = $user['role_examinateur'];
            $_SESSION['role_etudiant'] = $user['role_etudiant'];

            header('Location: index.php?controller=responsable&action=listProjets');
            exit();
        } else {
            echo "<p>Erreur de connexion</p>";
            self::formConnexion();
        }
    }


    public static function logout()
    {
        session_destroy();
        header('Location: index.php');
    }

    public static function formInscription()
    {
        require 'app/view/connexion/formInscription.php';
    }

    public static function register()
    {
        echo "<p>Inscription non encore implémentée.</p>";
    }
}
