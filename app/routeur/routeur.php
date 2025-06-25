<?php

$action = $_GET['action'] ?? 'index';

require_once __DIR__ . '/../controller/ControllerConnexion.php';
require_once __DIR__ . '/../controller/ControllerResponsable.php';
require_once __DIR__ . '/../controller/ControllerRdv.php';
require_once __DIR__ . '/../controller/ControllerInnovation.php';

switch ($action) {
    // Connexion & Inscription
    case 'index':
        ControllerConnexion::index();
        break;
    case 'formConnexion':
        ControllerConnexion::formConnexion();
        break;
    case 'login':
        ControllerConnexion::login();
        break;
    case 'logout':
        ControllerConnexion::logout();
        break;
    case 'formInscription':
        ControllerConnexion::formInscription();
        break;
    case 'register':
        ControllerConnexion::register();
        break;

    // Responsable
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

    // RDV
    case 'listRdvs':
        ControllerRdv::listRdvs();
        break;
    case 'detailRdv':
        ControllerRdv::detailRdv();
        break;

    default:
        http_response_code(404);
        echo "Erreur 404 : action « {$action} » inconnue.";
        break;

    // Innovations
    case 'proposeFeature':
        ControllerInnovation::proposeFeature();
        break;
    case 'proposeMVC':
        ControllerInnovation::proposeMVC();
        break;
}
