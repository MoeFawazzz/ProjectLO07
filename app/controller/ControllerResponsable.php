<?php
// app/controller/ControllerResponsable.php
require_once __DIR__ . '/../model/ModelProjet.php';
require_once __DIR__ . '/../model/ModelPersonne.php';

class ControllerResponsable
{
    private static function checkAuth()
    {
        if (empty($_SESSION['login_id']) || !$_SESSION['role_responsable']) {
            header('Location: index.php?action=formConnexion');
            exit();
        }
    }

    public static function listProjets()
    {
        self::checkAuth();
        $prs = ModelProjet::getProjetsByResponsable($_SESSION['login_id']);
        require __DIR__ . '/../view/responsable/listProjets.php';
    }

    public static function formAjoutProjet()
    {
        self::checkAuth();
        require __DIR__ . '/../view/responsable/formAjoutProjet.php';
    }

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

        ModelProjet::insertProjet($label, $groupe, $_SESSION['login_id']);
        header('Location: index.php?action=listProjets');
        exit();
    }

    public static function listExaminateurs()
    {
        self::checkAuth();
        $exs = ModelProjet::getAllExaminateurs();
        require __DIR__ . '/../view/responsable/listExaminateurs.php';
    }

    public static function formAjoutExaminateur()
    {
        self::checkAuth();
        require __DIR__ . '/../view/responsable/formAjoutExaminateur.php';
    }

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

        ModelPersonne::insertPersonne(
            $nom,
            $prenom,
            uniqid(),            // login unique
            substr(md5(uniqid()), 0, 20), // password tronqué à 20 caractères
            'examinateur'
        );
        header('Location: index.php?action=listExaminateurs');
        exit();
    }

    public static function listExaminateursProjet()
    {
        self::checkAuth();
        if (!empty($_POST['projet_id'])) {
            $id  = intval($_POST['projet_id']);
            $exs = ModelProjet::getExaminateursByProjet($id);
            require __DIR__ . '/../view/responsable/listExaminateursProjet.php';
        } else {
            $prs = ModelProjet::getProjetsByResponsable($_SESSION['login_id']);
            require __DIR__ . '/../view/responsable/formSelectProjet.php';
        }
    }

    public static function planningProjet()
    {
        self::checkAuth();
        if (!empty($_POST['projet_id'])) {
            $id  = intval($_POST['projet_id']);
            $rvs = ModelProjet::getPlanningByProjet($id);
            require __DIR__ . '/../view/responsable/planningProjet.php';
        } else {
            $prs = ModelProjet::getProjetsByResponsable($_SESSION['login_id']);
            require __DIR__ . '/../view/responsable/formSelectProjet.php';
        }
    }
}
