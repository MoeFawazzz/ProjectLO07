<?php
require_once __DIR__ . '/../model/ModelEtudiant.php';
require_once __DIR__ . '/../model/ModelProjet.php';
require_once __DIR__ . '/../core/View.php'; // Add this line to use View::render

class ControllerEtudiant
{
    private static function checkAuth()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['login_id']) || !$_SESSION['role_etudiant']) {
            header('Location: index.php?action=formConnexion');
            exit();
        }
    }

    public static function formPrendreRdv()
    {
        self::checkAuth();
        $creneaux = ModelEtudiant::getAvailableCreneaux();
        View::render('etudiant/formPrendreRdv', ['creneaux' => $creneaux]);
    }

public static function prendreRdv()
{
    self::checkAuth();

    if (!empty($_POST['creneau_id'])) {
        $creneauId = (int)$_POST['creneau_id'];
        $etudiantId = (int)$_SESSION['login_id'];

        $success = ModelEtudiant::prendreRdv($creneauId, $etudiantId);
        $message = $success ? "Rendez-vous réservé avec succès." : "Erreur lors de la réservation.";

        View::render('etudiant/message', ['message' => $message]);
    } else {
        $message = "Aucun créneau sélectionné.";
        View::render('etudiant/message', ['message' => $message]);
    }
}


public static function listRdvs()
{
    self::checkAuth();

    $etudiantId = (int)$_SESSION['login_id'];
    $rdvs = ModelEtudiant::getRdvsByEtudiant($etudiantId);

    $info = ModelPersonne::getNomPrenomById($etudiantId);
    $nomComplet = $info ? $info['prenom'] . ' ' . $info['nom'] : 'Inconnu';

    View::render('etudiant/listRdvs', [
        'rdvs' => $rdvs,
        'nomEtudiant' => $nomComplet
    ]);
}
public static function notifications()
{
    self::checkAuth();
    $id = $_SESSION['login_id'];
    ModelNotification::markAllAsRead($id);
    $notifications = ModelNotification::getAllByEtudiant($id);
    View::render('etudiant/notifications', ['notifications' => $notifications]);
}



}
