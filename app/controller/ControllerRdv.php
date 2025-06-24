<?php
require_once __DIR__ . '/../model/ModelRdv.php';

class ControllerRdv
{
    public static function listRdvs()
    {
        $rdvs = ModelRdv::getAll();
        require __DIR__ . '/../view/rdv/listRdvs.php';
    }

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