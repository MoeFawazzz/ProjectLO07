<?php

$action = $_GET['action'] ?? 'index';
$controller = $_GET['controller'] ?? '';

require_once __DIR__ . '/../controller/ControllerConnexion.php';
require_once __DIR__ . '/../controller/ControllerResponsable.php';
require_once __DIR__ . '/../controller/ControllerRdv.php';
require_once __DIR__ . '/../controller/ControllerExaminateur.php';
require_once __DIR__ . '/../controller/ControllerInnovation.php';
require_once 'app/controller/ControllerEtudiant.php';
require_once __DIR__ . '/../controller/ControllerNotification.php';

switch ($action) {
    // ------------------------
    // Connexion & Inscription
    // ------------------------
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

    // ------------------------
    // Responsable
    // ------------------------
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

    // ------------------------
    // Examinateur
    // ------------------------
    case 'planning':
        ControllerExaminateur::planning();
        break;
case 'listProjetsExam':
    ControllerExaminateur::listProjetsExam();
    break;
    case 'listExaminateursProjet':
        ControllerExaminateur::listExaminateursProjet();
        break;
    case 'planningProjet':
        ControllerExaminateur::planningProjet();
        break;
    case 'formSelectProjetCreneaux':
    ControllerExaminateur::formSelectProjetCreneaux();
        break;
    case 'creneauxProjet':
    ControllerExaminateur::creneauxProjet();
        break;
case 'formAjoutCreneau':
    ControllerExaminateur::formAjoutCreneau();
    break;

case 'ajoutCreneau':
    ControllerExaminateur::ajoutCreneau();
    break;

 case 'formAjoutCreneauxConsecutifs':
    ControllerExaminateur::formAjoutCreneauxConsecutifs();
    break;

case 'ajoutCreneauxConsecutifs':
    ControllerExaminateur::ajoutCreneauxConsecutifs();
    break;
    case 'formEditCreneau':
    ControllerExaminateur::formEditCreneau();
    break;

case 'editCreneau':
    ControllerExaminateur::editCreneau();
    break;

case 'deleteCreneau':
    ControllerExaminateur::deleteCreneau();
    break;
  // ------------------------
    // Etudiant
    // ------------------------
    case 'formPrendreRdv':
    ControllerEtudiant::formPrendreRdv();
    break;

case 'prendreRdv':
    ControllerEtudiant::prendreRdv();
    break;
    
    case 'listRdvs':
    ControllerEtudiant::listRdvs();
    break;

case 'etudiant':
 
    $action = $_GET['action'] ?? 'defaultAction';

    if (method_exists('ControllerEtudiant', $action)) {
        ControllerEtudiant::$action();
    } else {
        echo "Action $action non trouvée dans ControllerEtudiant.";
    }
    break;

    // ------------------------
    // RDV
    // ------------------------
    case 'listRdvs':
        ControllerRdv::listRdvs();
        break;
    case 'detailRdv':
        ControllerRdv::detailRdv();
        break;

        case 'listNotifications':
    ControllerNotification::listNotifications();
    break;

    case 'delete':
    ControllerNotification::delete();
    break;
    // ------------------------
    // Default
    // ------------------------
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
