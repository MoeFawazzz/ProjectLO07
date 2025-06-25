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

    /**
     * Récupère la liste des RDV pour un étudiant donné
     *
     * @param int $etudiantId
     * @return array
     */
    public static function getRdvsByEtudiant(int $etudiantId): array
    {
        // Utilise la vue SQL infordv pour ne pas répéter les JOIN
        $sql = "SELECT * 
            FROM infordv 
            WHERE etudiant_id = :eid 
            ORDER BY creneau";
        return self::selectAll($sql, ['eid' => $etudiantId]);
    }
}
