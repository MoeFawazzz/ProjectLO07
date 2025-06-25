<?php
// app/model/ModelProjet.php
require_once __DIR__ . '/Model.php';

class ModelProjet extends Model
{
    /** Récupère un projet (label + groupe) */
    public static function getProjetById(int $id)
    {
        $sql = "SELECT label, groupe FROM projet WHERE id = :id";
        return self::selectOne($sql, ['id' => $id]);
    }

    /** Projets d’un responsable */
    public static function getProjetsByResponsable(int $respId): array
    {
        $sql = "SELECT id, label, groupe
                FROM projet
                WHERE responsable = :res";
        return self::selectAll($sql, ['res' => $respId]);
    }

    /** Insère un projet (génération manuelle d’id si nécessaire) */
    public static function insertProjet(string $label, int $groupe, int $respId): bool
    {
        $newId = self::getNextId('projet');
        $sql = "INSERT INTO projet (id, label, groupe, responsable)
                VALUES (:id, :lab, :grp, :res)";
        return self::executeQuery($sql, [
            'id'  => $newId,
            'lab' => $label,
            'grp' => $groupe,
            'res' => $respId,
        ]);
    }

    /** Tous les examinateurs */
    public static function getAllExaminateurs(): array
    {
        $sql = "SELECT id, nom, prenom
                FROM personne
                WHERE role_examinateur = 1";
        return self::selectAll($sql);
    }

    /** Examinateurs d’un projet */
    public static function getExaminateursByProjet(int $projetId): array
    {
        $sql = "SELECT DISTINCT p.id, p.nom, p.prenom
                FROM infocreneaux ic
                JOIN personne p ON p.id = ic.examinateur_id
                WHERE ic.projet_id = :p";
        return self::selectAll($sql, ['p' => $projetId]);
    }

    /** Planning (creneau + examinateur + étudiants groupés) */
    public static function getPlanningByProjet(int $projetId): array
    {
        $sql = "
            SELECT 
              cr.creneau AS datetime,
              CONCAT(ex.prenom,' ',ex.nom) AS examinateur,
              GROUP_CONCAT(
                DISTINCT CONCAT(et.prenom,' ',et.nom)
                ORDER BY et.nom SEPARATOR ', '
              ) AS etudiants
            FROM creneau cr
            JOIN personne ex ON ex.id = cr.examinateur
            LEFT JOIN rdv r ON r.creneau = cr.id
            LEFT JOIN personne et ON et.id = r.etudiant
            WHERE cr.projet = :p
            GROUP BY cr.id, cr.creneau, ex.prenom, ex.nom
            ORDER BY cr.creneau
        ";
        return self::selectAll($sql, ['p' => $projetId]);
    }

public static function getPlanningByExaminateur(int $idExaminateur): array {
    $sql = "SELECT CR.id as creneau_id, PJ.label as projet_label, CR.creneau
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
    $sql = "SELECT CR.creneau, ET.prenom AS etudiant_prenom, ET.nom AS etudiant_nom
            FROM creneau CR
            LEFT JOIN rdv R ON R.creneau = CR.id
            LEFT JOIN personne ET ON R.etudiant = ET.id
            WHERE CR.projet = :id
            ORDER BY CR.creneau ASC";

    return self::selectAll($sql, ['id' => $projetId]);
}

public static function getCreneauxByExaminateur(int $idExaminateur): array {
    $sql = "SELECT CR.id AS creneau_id, PJ.label, CR.creneau, 
                   ET.nom AS etudiant_nom, ET.prenom AS etudiant_prenom
            FROM creneau CR
            JOIN projet PJ ON CR.projet = PJ.id
            LEFT JOIN rdv R ON CR.id = R.creneau
            LEFT JOIN personne ET ON R.etudiant = ET.id
            WHERE CR.examinateur = :idExaminateur
            ORDER BY CR.creneau";

    return self::selectAll($sql, ['idExaminateur' => $idExaminateur]);
}


}

