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
        // utilisateur non connecté → formulaire
        if (empty($_SESSION['login_id'])) {
            self::formConnexion();
            return;
        }

        // étudiant connecté → ses RDV seulement
        if (!empty($_SESSION['role_etudiant'])) {
            ControllerRdv::listMesRdvs();
            return;
        }

        // sinon (responsable ou examinateur) → tous les RDV
        ControllerRdv::listRdvs();
    }

    /** Formulaire de connexion */
    public static function formConnexion()
    {
        View::render('connexion/formConnexion');
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
        View::render('connexion/formInscription');
    }

    /** Traitement de l’inscription */
    public static function register()
    {
        $nom     = trim($_POST['nom']     ?? '');
        $prenom  = trim($_POST['prenom']  ?? '');
        $login   = trim($_POST['login']   ?? '');
        $pwd     = trim($_POST['password'] ?? '');
        $roles   = $_POST['roles']        ?? [];  // un tableau de 0 à 3 rôles

        // Validation : tous les champs + au moins un rôle
        if (
            $nom === '' || $prenom === '' ||
            $login === '' || $pwd === '' ||
            !is_array($roles) || empty($roles)
        ) {
            $_SESSION['error_message'] = 'Merci de remplir tous les champs et de choisir au moins un rôle.';
            header('Location: index.php?action=formInscription');
            exit();
        }

        if (ModelPersonne::getByLogin($login) !== false) {
            $_SESSION['error_message'] = 'Ce login est déjà pris. Veuillez en choisir un autre.';
            header('Location: index.php?action=formInscription');
            exit();
        }

        // On tronque le mot de passe à 20 caractères pour tenir dans varchar(20)
        $pwd = substr($pwd, 0, 20);


        // On transmet le tableau des rôles au modèle
        $ok = ModelPersonne::insertPersonne($nom, $prenom, $login, $pwd, $roles);


        if (!$ok) {
            $_SESSION['error_message'] = 'Impossible de créer l’utilisateur.';
            header('Location: index.php?action=formInscription');
            exit();
        }

        $_SESSION['success_message'] = 'Inscription réussie, vous pouvez maintenant vous connecter.';
        header('Location: index.php?action=formConnexion');
        exit();
    }
}
