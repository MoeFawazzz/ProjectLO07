<?php
// app/model/ModelRdv.php
require_once __DIR__ . '/Model.php';

class ModelRdv extends Model
{
    /**
     * Récupère tous les rendez-vous via la vue infordv
     * @return array
     */
    public static function getAll(): array
    {
        $sql = "SELECT * FROM infordv ORDER BY rdv_id";
        return self::selectAll($sql);
    }

    /**
     * Récupère un rendez-vous par son ID
     * @param int $id
     * @return array|false
     */
    public static function getById(int $id)
    {
        $sql = "SELECT * FROM infordv WHERE rdv_id = :id";
        return self::selectOne($sql, ['id' => $id]);
    }
}
