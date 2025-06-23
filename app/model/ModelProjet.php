<?php
// app/model/ModelProjet.php
require_once __DIR__ . '/Model.php';

class ModelProjet extends Model
{
    public static function getProjetsByResponsable(int $respId): array
    {
        $sql = "SELECT id,label,groupe FROM projet WHERE responsable=:res";
        return self::selectAll($sql, ['res' => $respId]);
    }

    public static function insertProjet(string $label, int $groupe, int $respId): bool
    {
        $sql = "INSERT INTO projet (label,groupe,responsable)
                VALUES (:lab,:grp,:res)";
        return self::executeQuery($sql, [
            'lab' => $label,
            'grp' => $groupe,
            'res' => $respId
        ]);
    }

    public static function getAllExaminateurs(): array
    {
        $sql = "SELECT id,nom,prenom FROM personne WHERE role_examinateur=1";
        return self::selectAll($sql);
    }

    public static function getExaminateursByProjet(int $projetId): array
    {
        $sql = "SELECT DISTINCT p.id,p.nom,p.prenom
                FROM infocreneaux ic
                JOIN personne p ON p.id=ic.examinateur_id
                WHERE ic.projet_id=:p";
        return self::selectAll($sql, ['p' => $projetId]);
    }

    public static function getPlanningByProjet(int $projetId): array
    {
        $sql = "SELECT ic.date,ic.heure,p.nom AS examNom,p.prenom AS examPrenom
                FROM infocreneaux ic
                JOIN personne p ON p.id=ic.examinateur_id
                WHERE ic.projet_id=:p
                ORDER BY ic.date,ic.heure";
        return self::selectAll($sql, ['p' => $projetId]);
    }
}

?>