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
}
