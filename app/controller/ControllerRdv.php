<?php
// app/controller/ControllerRdv.php
require_once __DIR__ . '/../model/ModelRdv.php';

class ControllerRdv
{
    /**
     * Affiche la liste des rendez-vous
     */
    public static function listRdvs()
    {
        // (si vous avez besoin d'auth, insérez checkAuth() ici)
        $rdvs = ModelRdv::getAll();
        View::render('rdv/listRdvs', ['rdvs' => $rdvs]);
    }

    /**
     * Affiche le détail d’un rendez-vous
     */
    public static function detailRdv()
    {
        $id = intval($_GET['id'] ?? 0);
        if ($id > 0) {
            $rdv = ModelRdv::getById($id);
            View::render('rdv/detailRdv', ['rdv' => $rdv]);
        } else {
            header('Location: index.php?action=listRdvs');
            exit();
        }
    }
    public static function listMesRdvs()
    {
        // Vérifier la session / rôle étudiant
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['login_id']) || !$_SESSION['role_etudiant']) {
            header('Location: index.php?action=formConnexion');
            exit();
        }

        // Récupère les RDV filtrés
        $etudiantId = (int)$_SESSION['login_id'];
        $rdvs       = ModelRdv::getRdvsByEtudiant($etudiantId);

        View::render('rdv/listRdvs', ['rdvs' => $rdvs]);
    }
}
