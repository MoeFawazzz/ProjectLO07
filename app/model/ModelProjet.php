<?php
require_once 'app/model/Model.php';

class ModelProjet extends Model {

    public static function getProjetsByResponsable($id) {
        $sql = "SELECT * FROM projet WHERE responsable = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insertProjet($label, $idResponsable) {
        $sql = "INSERT INTO projet (label, responsable) VALUES (:label, :responsable)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            'label' => $label,
            'responsable' => $idResponsable
        ]);
    }

    public static function getAllExaminateurs() {
        $sql = "SELECT * FROM personne WHERE role_examinateur = 1";
        $stmt = self::$pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function ajouterExaminateurAuProjet($idProjet, $idExaminateur, $creneau) {
        $sql = "INSERT INTO creneau (projet, examinateur, creneau) VALUES (:projet, :examinateur, :creneau)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            'projet' => $idProjet,
            'examinateur' => $idExaminateur,
            'creneau' => $creneau
        ]);
    }

    public static function getExaminateursByProjet($idProjet) {
        $sql = "SELECT DISTINCT examinateur_id, nom, prenom
                FROM infocreneaux
                WHERE projet_id = :idProjet";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['idProjet' => $idProjet]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPlanningByProjet($idProjet) {
        $sql = "SELECT * FROM infordv WHERE projet_id = :idProjet";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['idProjet' => $idProjet]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
