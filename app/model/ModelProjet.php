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
        $sql = "SELECT DISTINCT p.id, p.nom, p.prenom
                FROM creneau c
                JOIN personne p ON c.examinateur = p.id
                WHERE c.projet = :idProjet";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['idProjet' => $idProjet]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPlanningByProjet($idProjet) {
        $sql = "SELECT et.nom AS etudiant_nom, et.prenom AS etudiant_prenom,
                       cr.creneau AS horaire,
                       ex.nom AS examinateur_nom, ex.prenom AS examinateur_prenom
                FROM rdv r
                JOIN creneau cr ON r.creneau = cr.id
                JOIN personne et ON r.etudiant = et.id
                JOIN personne ex ON cr.examinateur = ex.id
                WHERE cr.projet = :idProjet";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['idProjet' => $idProjet]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

