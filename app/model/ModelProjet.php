<?php
// app/model/ModelProjet.php
require_once __DIR__ . '/Model.php';

class ModelProjet extends Model
{
    public static function getProjetsByResponsable(int $respId): array
    {
        $sql = "SELECT id, label, groupe
                FROM projet
                WHERE responsable = :res";
        return self::selectAll($sql, ['res' => $respId]);
    }

    public static function insertProjet(string $label, int $groupe, int $respId): bool
    {
        // Génération manuelle de l'ID
        $newId = self::getNextId('projet');

        $sql = "INSERT INTO projet
                (id, label, groupe, responsable)
                VALUES
                (:id, :lab, :grp, :res)";
        return self::executeQuery($sql, [
            'id'  => $newId,
            'lab' => $label,
            'grp' => $groupe,
            'res' => $respId,
        ]);
    }

    public static function getAllExaminateurs(): array
    {
        $sql = "SELECT id, nom, prenom
                FROM personne
                WHERE role_examinateur = 1";
        return self::selectAll($sql);
    }

    public static function getExaminateursByProjet(int $projetId): array
    {
        $sql = "SELECT DISTINCT p.id, p.nom, p.prenom
                FROM infocreneaux ic
                JOIN personne p ON p.id = ic.examinateur_id
                WHERE ic.projet_id = :p";
        return self::selectAll($sql, ['p' => $projetId]);
    }

    public static function getPlanningByProjet(int $projetId): array
    {
        // Infocreneaux n'a pas de colonnes 'date'/'heure' : on découpe CR.creneau
        $sql = "SELECT 
                    DATE(creneau) AS date, 
                    TIME(creneau) AS heure,
                    examinateur_id,
                    nom       AS examNom,
                    prenom    AS examPrenom
                FROM infocreneaux
                WHERE projet_id = :p
                ORDER BY creneau";
        return self::selectAll($sql, ['p' => $projetId]);
    }
}
