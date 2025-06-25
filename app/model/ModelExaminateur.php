<?php
require_once 'app/model/Model.php';

class ModelExaminateur extends Model
{
    public static function getPlanningByExaminateur($idExaminateur)
    {
        $sql = "SELECT CR.id as creneau_id, PJ.label, CR.creneau
                FROM creneau CR
                JOIN projet PJ ON CR.projet = PJ.id
                WHERE CR.examinateur = :id
                ORDER BY CR.creneau ASC";

        return self::selectAll($sql, ['id' => $idExaminateur]);
    }

    public static function getProjetsByExaminateur($idExaminateur)
    {
        $sql = "SELECT DISTINCT PJ.id, PJ.label, PJ.groupe
                FROM creneau CR
                JOIN projet PJ ON CR.projet = PJ.id
                WHERE CR.examinateur = :id";

        return self::selectAll($sql, ['id' => $idExaminateur]);
    }

    public static function getCreneauxByProjet(int $projetId): array
    {
        $sql = "SELECT CR.id AS creneau_id, CR.creneau,
                       ET.nom AS etudiant_nom, ET.prenom AS etudiant_prenom
                FROM creneau CR
                LEFT JOIN rdv R ON CR.id = R.creneau
                LEFT JOIN personne ET ON R.etudiant = ET.id
                WHERE CR.projet = :id
                ORDER BY CR.creneau";

        return self::selectAll($sql, ['id' => $projetId]);
    }

    public static function insertCreneau(int $projetId, int $examinateurId, string $datetime): bool
    {
        $id = self::getNextId('creneau');
        $sql = "INSERT INTO creneau (id, projet, examinateur, creneau)
                VALUES (:id, :projet, :exam, :creneau)";

        return self::executeQuery($sql, [
            'id' => $id,
            'projet' => $projetId,
            'exam' => $examinateurId,
            'creneau' => $datetime
        ]);
    }
}
