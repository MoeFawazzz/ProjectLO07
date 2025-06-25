<?php
// app/controller/ControllerResponsable.php
require_once __DIR__ . '/../model/ModelProjet.php';
require_once __DIR__ . '/../model/ModelPersonne.php';

class ControllerResponsable
{
    // 1) Vérifie que l’utilisateur est connecté ET responsable
    private static function checkAuth()
    {
        if (empty($_SESSION['login_id']) || !$_SESSION['role_responsable']) {
            header('Location: index.php?action=formConnexion');
            exit();
        }
    }

    // 2) LISTE DES PROJETS
    public static function listProjets()
    {
        self::checkAuth();
        $prs = ModelProjet::getProjetsByResponsable((int)$_SESSION['login_id']);
        require __DIR__ . '/../view/responsable/listProjets.php';
    }

    // 3) FORMULAIRE AJOUT PROJET
    public static function formAjoutProjet()
    {
        self::checkAuth();
        require __DIR__ . '/../view/responsable/formAjoutProjet.php';
    }

    // 4) TRAITEMENT AJOUT PROJET
    public static function ajoutProjet()
    {
        self::checkAuth();
        $label  = trim($_POST['label']  ?? '');
        $groupe = intval($_POST['groupe'] ?? 0);
        if ($label === '' || $groupe < 1 || $groupe > 5) {
            $_SESSION['error_message'] = 'Données invalides pour le projet.';
            header('Location: index.php?action=formAjoutProjet');
            exit();
        }
        ModelProjet::insertProjet($label, $groupe, (int)$_SESSION['login_id']);
        header('Location: index.php?action=listProjets');
        exit();
    }

    // 5) LISTE DES EXAMINATEURS
    public static function listExaminateurs()
    {
        self::checkAuth();
        $exs = ModelProjet::getAllExaminateurs();
        require __DIR__ . '/../view/responsable/listExaminateurs.php';
    }

    // 6) FORMULAIRE AJOUT EXAMINATEUR
    public static function formAjoutExaminateur()
    {
        self::checkAuth();
        require __DIR__ . '/../view/responsable/formAjoutExaminateur.php';
    }

    // 7) TRAITEMENT AJOUT EXAMINATEUR
    public static function ajoutExaminateur()
{
    self::checkAuth();
    $nom    = trim($_POST['nom']    ?? '');
    $prenom = trim($_POST['prenom'] ?? '');

    if ($nom === '' || $prenom === '') {
        $_SESSION['error_message'] = 'Données invalides pour l\'examinateur.';
        header('Location: index.php?action=formAjoutExaminateur');
        exit();
    }

    // 1) Génération tronquée pour coller au varchar(20)
    $login    = substr(uniqid(), 0, 15);
    $password = substr(md5(uniqid()), 0, 20);

    // 2) Insertion en base
    ModelPersonne::insertPersonne($nom, $prenom, $login, $password, 'examinateur');

    // 3) Message de confirmation (facultatif)
    $_SESSION['success_message'] =
        "Examinateur créé !<br>"
      . "Login : <strong>$login</strong><br>"
      . "Mot de passe : <strong>$password</strong>";

    header('Location: index.php?action=listExaminateurs');
    exit();
}


    // 8) LISTE DES EXAMINATEURS D’UN PROJET
    public static function listExaminateursProjet()
    {
        self::checkAuth();
        if (!empty($_POST['projet_id'])) {
            $id  = intval($_POST['projet_id']);
            $exs = ModelProjet::getExaminateursByProjet($id);
            require __DIR__ . '/../view/responsable/listExaminateursProjet.php';
        } else {
            $prs = ModelProjet::getProjetsByResponsable((int)$_SESSION['login_id']);
            require __DIR__ . '/../view/responsable/formSelectProjet.php';
        }
    }

    // 9) PLANNING D’UN PROJET
    public static function planningProjet()
    {
        self::checkAuth();
        if (!empty($_POST['projet_id'])) {
            $id   = intval($_POST['projet_id']);
            $proj = ModelProjet::getProjetById($id);
            $rvs  = ModelProjet::getPlanningByProjet($id);
            require __DIR__ . '/../view/responsable/planningProjet.php';
        } else {
            $prs = ModelProjet::getProjetsByResponsable((int)$_SESSION['login_id']);
            require __DIR__ . '/../view/responsable/formSelectProjet.php';
        }
    }
}
