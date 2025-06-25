<?php
// app/model/ModelEtudiant.php
require_once 'Model.php';

class ModelEtudiant extends Model
{
    public static function getAvailableCreneaux(): array
    {
        $sql = "SELECT CR.id AS creneau_id, PJ.label AS projet_label, CR.creneau
                FROM creneau CR
                JOIN projet PJ ON CR.projet = PJ.id
                LEFT JOIN rdv R ON R.creneau = CR.id
                WHERE R.etudiant IS NULL
                ORDER BY CR.creneau";
        return self::selectAll($sql);
    }

    public static function prendreRdv(int $creneauId, int $etudiantId): bool
    {
        $id = self::getNextId('rdv');
        $sql = "INSERT INTO rdv (id, etudiant, creneau)
                VALUES (:id, :etudiant, :creneau)";
        return self::executeQuery($sql, [
            'id' => $id,
            'etudiant' => $etudiantId,
            'creneau' => $creneauId
        ]);
    }

public static function getRdvsByEtudiant(int $etudiantId): array
{
    $sql = "SELECT 
              RDV.id AS rdv_id,
              PJ.label AS projet,
              CR.creneau AS date_heure,
              CONCAT(EX.prenom, ' ', EX.nom) AS examinateur
            FROM rdv RDV
            JOIN creneau CR ON CR.id = RDV.creneau
            JOIN projet PJ ON PJ.id = CR.projet
            JOIN personne EX ON EX.id = CR.examinateur
            WHERE RDV.etudiant = :id
            ORDER BY CR.creneau ASC";

    return self::selectAll($sql, ['id' => $etudiantId]);
}



}
