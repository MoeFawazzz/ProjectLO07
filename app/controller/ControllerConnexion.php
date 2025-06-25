<?php
// app/controller/ControllerConnexion.php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../model/ModelPersonne.php';
require_once __DIR__ . '/../controller/ControllerRdv.php';  // pour index()

class ControllerConnexion
{
    /** Page d’accueil (avant ou après connexion) */
    public static function index()
    {
        // Si non connecté, afficher la page de connexion
        if (empty($_SESSION['login_id'])) {
            self::formConnexion();
        } else {
            // sinon, rediriger vers la liste des RDV par défaut
            ControllerRdv::listRdvs();
        }
    }

    /** Formulaire de connexion */
    public static function formConnexion()
    {
        require __DIR__ . '/../view/connexion/formConnexion.php';
    }

    /** Traitement du login */
    public static function login()
    {
        $login = trim($_POST['login'] ?? '');
        $pwd   = trim($_POST['password'] ?? '');
        if ($login === '' || $pwd === '') {
            $_SESSION['error_message'] = "Login/mot de passe manquant.";
            header('Location: index.php?action=formConnexion');
            exit();
        }
        $user = ModelPersonne::getByLoginPassword($login, $pwd);
        if (!$user) {
            $_SESSION['error_message'] = "Identifiants invalides.";
            header('Location: index.php?action=formConnexion');
            exit();
        }
        // Remplir la session
        $_SESSION['login_id']     = $user['id'];
        $_SESSION['login_nom']    = $user['nom'];
        $_SESSION['login_prenom'] = $user['prenom'];
        $_SESSION['role_responsable']  = (bool)$user['role_responsable'];
        $_SESSION['role_examinateur']  = (bool)$user['role_examinateur'];
        $_SESSION['role_etudiant']     = (bool)$user['role_etudiant'];
        header('Location: index.php?action=index');
        exit();
    }

    /** Déconnexion */
    public static function logout()
{
    // S'il n'y a pas déjà de session, on démarre
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // On vide complètement la session
    $_SESSION = [];
    session_destroy();

    // Puis on redirige sur la page d'accueil « froide »
    header('Location: index.php');
    exit();
}

    /** Formulaire d’inscription */
    public static function formInscription()
    {
        require __DIR__ . '/../view/connexion/formInscription.php';
    }

    /** Traitement de l’inscription */
    public static function register()
    {
        $nom    = trim($_POST['nom']    ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $login  = trim($_POST['login']  ?? '');
        $pwd    = trim($_POST['password'] ?? '');
        $role   = $_POST['role'] ?? '';
        if ($nom === '' || $prenom === '' || $login === '' || $pwd === '' 
            || !in_array($role, ['responsable','examinateur','etudiant'])) 
        {
            $_SESSION['error_message'] = 'Données d’inscription invalides.';
            header('Location: index.php?action=formInscription');
            exit();
        }
        $pwd = substr($pwd, 0, 20);  // tronque à 20 chars
        $ok = ModelPersonne::insertPersonne($nom, $prenom, $login, $pwd, $role);
        if (!$ok) {
            $_SESSION['error_message'] = 'Impossible de créer l’utilisateur.';
            header('Location: index.php?action=formInscription');
            exit();
        }
        $_SESSION['success_message'] = 'Inscription réussie, connectez-vous.';
        header('Location: index.php?action=formConnexion');
        exit();
    }
}
