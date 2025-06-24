<?php
// app/controller/ControllerConnexion.php
require_once __DIR__ . '/../model/ModelPersonne.php';

class ControllerConnexion
{
    public static function formConnexion()
    {
        require __DIR__ . '/../view/connexion/formConnexion.php';
    }

    public static function login()
    {
        $login    = trim($_POST['login']    ?? '');
        $password = trim($_POST['password'] ?? '');

        $user = ModelPersonne::getByLoginPassword($login, $password);
        if ($user) {
            // Authentification réussie
            session_start();
            $_SESSION['login_id']        = $user['id'];
            $_SESSION['login_nom']       = $user['nom'];
            $_SESSION['login_prenom']    = $user['prenom'];
            $_SESSION['role_responsable']= (bool)$user['role_responsable'];
            $_SESSION['role_examinateur']= (bool)$user['role_examinateur'];
            $_SESSION['role_etudiant']   = (bool)$user['role_etudiant'];
            header('Location: index.php?action=index');
            exit();
        } else {
            // Échec
            session_start();
            $_SESSION['error_message'] = 'Login ou mot de passe invalide.';
            header('Location: index.php?action=formConnexion');
            exit();
        }
    }

    public static function formInscription()
    {
        require __DIR__ . '/../view/connexion/formInscription.php';
    }

    public static function register()
    {
        $nom      = trim($_POST['nom']      ?? '');
        $prenom   = trim($_POST['prenom']   ?? '');
        $login    = trim($_POST['login']    ?? '');
        $password = trim($_POST['password'] ?? '');
        $role     = $_POST['role'] ?? '';

        // Validation basique
        if ($nom === '' || $prenom === '' || $login === '' || $password === '' ||
            !in_array($role, ['responsable','examinateur','etudiant'], true)) {
            $_SESSION['error_message'] = 'Veuillez remplir tous les champs correctement.';
            header('Location: index.php?action=formInscription');
            exit();
        }

        // TODO : vérifier l’unicité du login avant insertion
        $ok = ModelPersonne::insertPersonne($nom, $prenom, $login, $password, $role);
        if ($ok) {
            $_SESSION['success_message'] = 'Inscription réussie ! Vous pouvez maintenant vous connecter.';
            header('Location: index.php?action=formConnexion');
            exit();
        } else {
            $_SESSION['error_message'] = 'Erreur lors de l\'inscription.';
            header('Location: index.php?action=formInscription');
            exit();
        }
    }

    public static function logout()
    {
        session_destroy();
        header('Location: index.php?action=index');
        exit();
    }
}
