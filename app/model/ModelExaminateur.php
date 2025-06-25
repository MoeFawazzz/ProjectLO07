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

  public static function getProjetsByExaminateur(int $examinateurId): array
{
    $sql = "
        SELECT DISTINCT PJ.id, PJ.label, PJ.groupe
        FROM projet PJ
        WHERE PJ.id IN (
            SELECT CR.projet
            FROM creneau CR
            WHERE CR.examinateur = :id
        )
        OR PJ.responsable = :id
    ";

    return self::selectAll($sql, ['id' => $examinateurId]);
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
public static function getCreneauById(int $id): ?array
{
    $sql = "SELECT CR.id, CR.projet, PJ.label AS projet_label, CR.examinateur, CR.creneau,
                   ET.id AS etudiant_id, ET.nom AS etudiant_nom, ET.prenom AS etudiant_prenom
            FROM creneau CR
            JOIN projet PJ ON PJ.id = CR.projet
            LEFT JOIN rdv R ON R.creneau = CR.id
            LEFT JOIN personne ET ON ET.id = R.etudiant
            WHERE CR.id = :id";
    return self::selectOne($sql, ['id' => $id]);
}


public static function updateCreneau(int $id, string $datetime): bool
{
    $sql = "UPDATE creneau SET creneau = :creneau WHERE id = :id";
    return self::executeQuery($sql, [
        'id' => $id,
        'creneau' => $datetime
    ]);
}

public static function getAllEtudiants(): array
{
    $sql = "SELECT id, prenom, nom FROM personne WHERE role_etudiant = 1";
    return self::selectAll($sql);
}

public static function doesCreneauExist(string $datetime, int $excludeId): bool
{
    $sql = "SELECT COUNT(*) as count FROM creneau WHERE creneau = :dt AND id != :id";
    $res = self::selectOne($sql, ['dt' => $datetime, 'id' => $excludeId]);
    return $res && $res['count'] > 0;
}

public static function assignEtudiantToCreneau(int $creneauId, int $etudiantId): bool
{
    // Check if RDV exists for this créneau
    $sqlCheck = "SELECT COUNT(*) as count FROM rdv WHERE creneau = :id";
    $res = self::selectOne($sqlCheck, ['id' => $creneauId]);

    if ($res && $res['count'] > 0) {
        // Update existing RDV
        $sqlUpdate = "UPDATE rdv SET etudiant = :etu WHERE creneau = :id";
        return self::executeQuery($sqlUpdate, ['etu' => $etudiantId, 'id' => $creneauId]);
    } else {
        // Insert new RDV
        $newId = self::getNextId('rdv');
        $sqlInsert = "INSERT INTO rdv (id, creneau, etudiant) VALUES (:id, :cr, :etu)";
        return self::executeQuery($sqlInsert, ['id' => $newId, 'cr' => $creneauId, 'etu' => $etudiantId]);
    }
}

public static function deleteCreneauById(int $id): bool
{
    $sql = "DELETE FROM creneau WHERE id = :id";
    return self::executeQuery($sql, ['id' => $id]);
}

public static function isCreneauConflict($projetId, $datetime): bool
{
    $sql = "SELECT COUNT(*) AS count FROM creneau 
            WHERE projet = :projet AND creneau = :datetime";
    $result = self::selectOne($sql, [
        'projet' => $projetId,
        'datetime' => $datetime
    ]);
    return $result && $result['count'] > 0;
}

}
