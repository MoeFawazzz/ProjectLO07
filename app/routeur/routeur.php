<?php
// app/routeur/routeur.php

// Charge les contrôleurs
require_once __DIR__ . '/../controller/ControllerConnexion.php';
require_once __DIR__ . '/../controller/ControllerResponsable.php';
require_once __DIR__ . '/../controller/ControllerRdv.php';

// Récupère l'action depuis l'URL et la sanitise
$action = $_GET['action'] ?? 'index';
$action = preg_replace('/[^a-zA-Z0-9_]/', '', $action);

// Dispatche vers la méthode correspondante
switch ($action) {
    // Authentification
    case 'formConnexion':
        ControllerConnexion::formConnexion();
        break;
    case 'login':
        ControllerConnexion::login();
        break;
    case 'formInscription':
        ControllerConnexion::formInscription();
        break;
    case 'register':
        ControllerConnexion::register();
        break;
    case 'logout':
        ControllerConnexion::logout();
        break;

    // Responsables
    case 'listProjets':
        ControllerResponsable::listProjets();
        break;
    case 'formAjoutProjet':
        ControllerResponsable::formAjoutProjet();
        break;
    case 'ajoutProjet':
        ControllerResponsable::ajoutProjet();
        break;
    case 'listExaminateurs':
        ControllerResponsable::listExaminateurs();
        break;
    case 'formAjoutExaminateur':
        ControllerResponsable::formAjoutExaminateur();
        break;
    case 'ajoutExaminateur':
        ControllerResponsable::ajoutExaminateur();
        break;
    case 'listExaminateursProjet':
        ControllerResponsable::listExaminateursProjet();
        break;
    case 'planningProjet':
        ControllerResponsable::planningProjet();
        break;

    // Rdvs
    case 'listRdvs':
        ControllerRdv::listRdvs();
        break;
    case 'detailRdv':
        ControllerRdv::detailRdv();
        break;

    // Page d’accueil par défaut
    case 'index':
    default:
        ControllerRdv::listRdvs();
        break;
}