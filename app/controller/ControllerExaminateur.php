<?php
// app/controller/ControllerExaminateur.php

require_once __DIR__ . '/../model/ModelProjet.php';
require_once __DIR__ . '/../model/ModelPersonne.php';
require_once __DIR__ . '/../model/Model.php';
require_once __DIR__ . '/../model/ModelExaminateur.php';
class ControllerExaminateur
{
    // Vérifie que l'utilisateur est connecté et examinateur
    private static function checkAuth()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['login_id']) || !$_SESSION['role_examinateur']) {
            header('Location: index.php?action=formConnexion');
            exit();
        }
    }



    // 2) Liste de tous les créneaux de l’examinateur
public static function planning()
{
    self::checkAuth();
    $idExaminateur = (int)$_SESSION['login_id'];
    $creneaux = ModelProjet::getCreneauxByExaminateur($idExaminateur);
    require __DIR__ . '/../view/examinateur/planningTout.php';
}


    // 3) Sélectionner un projet pour afficher ses examinateurs
  public static function listExaminateursProjet()
{
    self::checkAuth();

    if (!empty($_POST['projet_id'])) {
        $id = intval($_POST['projet_id']);
        $exs = ModelProjet::getExaminateursByProjet($id);
        require __DIR__ . '/../view/examinateur/listExaminateursProjet.php';
    } else {
        $prs = ModelProjet::getProjetsByExaminateur((int)$_SESSION['login_id']); // ✅ modifié ici
        $action = 'index.php?controller=examinateur&action=listExaminateursProjet';
        require __DIR__ . '/../view/examinateur/formSelectProjet.php';
    }
}


    // 4) Sélectionner un projet pour voir son planning complet (soutenances)
   public static function planningProjet()
{
    self::checkAuth();

    if (!empty($_POST['projet_id'])) {
        $id = intval($_POST['projet_id']);
        $proj = ModelProjet::getProjetById($id);
        $rvs = ModelProjet::getPlanningByProjet($id);
        require __DIR__ . '/../view/examinateur/planningProjet.php';
    } else {
        $prs = ModelProjet::getProjetsByExaminateur((int)$_SESSION['login_id']); // ✅ modifié ici
        $action = 'index.php?controller=examinateur&action=planningProjet';
        require __DIR__ . '/../view/examinateur/formSelectProjet.php';
    }
}

public static function formSelectProjetCreneaux()
{
    self::checkAuth();
    $prs = ModelProjet::getProjetsByExaminateur((int)$_SESSION['login_id']); // ✅ modifié ici
    $action = 'index.php?controller=examinateur&action=creneauxProjet';
    require __DIR__ . '/../view/examinateur/formSelectProjet.php';
}



public static function creneauxProjet()
{
    self::checkAuth();

    if (!empty($_POST['projet_id'])) {
        $id = intval($_POST['projet_id']);
        $proj = ModelProjet::getProjetById($id); 
        $creneaux = ModelProjet::getCreneauxByProjet($id);
        require __DIR__ . '/../view/examinateur/listCreneauxProjet.php';
    } else {
        header('Location: index.php?controller=examinateur&action=formSelectProjetCreneaux');
        exit();
    }
}

   public static function listProjetsExam()
    {
        self::checkAuth();
        $prs = ModelProjet::getProjetsByResponsable((int)$_SESSION['login_id']);
        require __DIR__ . '/../view/responsable/listProjets.php';
    }

public static function formAjoutCreneau()
{
    self::checkAuth();
    $idExaminateur = (int)$_SESSION['login_id'];
    $prs = ModelProjet::getProjetsByExaminateur($idExaminateur); // ✅ modifié ici
    $action = 'index.php?controller=examinateur&action=ajoutCreneau';
    require __DIR__ . '/../view/examinateur/formAjoutCreneau.php';
}

public static function ajoutCreneau()
{
    self::checkAuth();

    if (!empty($_POST['projet_id']) && !empty($_POST['datetime'])) {
        $projetId = (int)$_POST['projet_id'];
        $datetime = $_POST['datetime'];
        $examId = (int)$_SESSION['login_id'];

        $success = ModelExaminateur::insertCreneau($projetId, $examId, $datetime);

        if ($success) {
            $message = "Créneau ajouté avec succès.";
        } else {
            $message = "Erreur lors de l'ajout.";
        }

        require __DIR__ . '/../view/examinateur/message.php';
    } else {
        header('Location: index.php?controller=examinateur&action=formAjoutCreneau');
        exit();
    }
}

public static function formAjoutCreneauxConsecutifs()
{
    self::checkAuth();
    $idExam = (int)$_SESSION['login_id'];
    $projets = ModelProjet::getProjetsByExaminateur($idExam); // ✅ modifié ici
    require __DIR__ . '/../view/examinateur/formAjoutCreneauxConsecutifs.php';
}


public static function ajoutCreneauxConsecutifs()
{
    self::checkAuth();

    if (!empty($_POST['projet_id']) && !empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST['nb'])) {
        $projetId = (int)$_POST['projet_id'];
        $examId = (int)$_SESSION['login_id'];
        $datetime = new DateTime($_POST['date'] . ' ' . $_POST['heure']);
        $nb = min(max((int)$_POST['nb'], 1), 10); // entre 1 et 10

        for ($i = 0; $i < $nb; $i++) {
            $dateStr = $datetime->format('Y-m-d H:i:s');
            ModelExaminateur::insertCreneau($projetId, $examId, $dateStr);
            $datetime->modify('+1 hour');
        }

        header('Location: index.php?controller=examinateur&action=planning');
        exit();
    } else {
        echo "<p class='text-danger'>Données incomplètes</p>";
    }
}


}
