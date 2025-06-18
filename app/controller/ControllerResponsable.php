<?php

require_once 'app/model/ModelProjet.php';

class ControllerResponsable
{

    public static function listProjets()
    {
        session_start();
        $id = $_SESSION['login_id'] ?? null;
        $projets = ModelProjet::getProjetsByResponsable($id);
        require 'app/view/responsable/listProjets.php';
    }

    public static function formAjoutProjet()
    {
        require 'app/view/responsable/formAjoutProjet.php';
    }

    public static function ajoutProjet()
    {
        session_start();
        $id = $_SESSION['login_id'] ?? null;
        $label = $_POST['label'] ?? '';
        ModelProjet::insertProjet($label, $id);
        self::listProjets();
    }

    public static function listExaminateurs()
    {
        $examinateurs = ModelProjet::getAllExaminateurs();
        require 'app/view/responsable/listExaminateurs.php';
    }

    public static function formAjoutExaminateur()
    {
        session_start();
        $id = $_SESSION['login_id'] ?? null;
        $projets = ModelProjet::getProjetsByResponsable($id);
        $examinateurs = ModelProjet::getAllExaminateurs();
        require 'app/view/responsable/formAjoutExaminateur.php';
    }

    public static function ajoutExaminateur()
    {
        $idProjet = $_POST['idProjet'] ?? null;
        $idExaminateur = $_POST['idExaminateur'] ?? null;
        $creneau = $_POST['creneau'] ?? null;
        ModelProjet::ajouterExaminateurAuProjet($idProjet, $idExaminateur, $creneau);
        self::listProjets();
    }

    public static function listExaminateursProjet()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProjet = $_POST['idProjet'] ?? null;
            $examinateurs = ModelProjet::getExaminateursByProjet($idProjet);
            require('app/view/responsable/listExaminateursProjet.php');
        } else {
            session_start();
            $id = $_SESSION['login_id'] ?? null;
            $projets = ModelProjet::getProjetsByResponsable($id);
            require('app/view/responsable/formSelectProjet.php');
        }
    }

    public static function planningProjet()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProjet = $_POST['idProjet'] ?? null;
            $rdvs = ModelProjet::getPlanningByProjet($idProjet);
            require('app/view/responsable/planningProjet.php');
        } else {
            if (session_status() === PHP_SESSION_NONE) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
            }

            $id = $_SESSION['login_id'] ?? null;
            $projets = ModelProjet::getProjetsByResponsable($id);
            require('app/view/responsable/formSelectProjet.php');
        }
    }
}
