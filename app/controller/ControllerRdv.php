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
        require __DIR__ . '/../view/rdv/listRdvs.php';
    }

    /**
     * Affiche le détail d’un rendez-vous
     */
    public static function detailRdv()
    {
        $id = intval($_GET['id'] ?? 0);
        if ($id > 0) {
            $rdv = ModelRdv::getById($id);
            require __DIR__ . '/../view/rdv/detailRdv.php';
        } else {
            header('Location: index.php?action=listRdvs');
            exit();
        }
    }
}
