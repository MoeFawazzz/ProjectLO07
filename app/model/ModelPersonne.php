<?php
// app/model/ModelPersonne.php
require_once __DIR__ . '/Model.php';

class ModelPersonne extends Model
{
    public static function getByLoginPassword(string $login, string $pwd)
    {
        $sql = "SELECT * FROM personne WHERE login = :login AND password = :pwd";
        return self::selectOne($sql, ['login' => $login, 'pwd' => $pwd]);
    }

    public static function insertPersonne(
        string $nom,
        string $prenom,
        string $login,
        string $password,
        $roles
    ): bool {
        // On veut un tableau de rôles
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        // Initialisation des flags à 0
        $flags = [
            'responsable'  => 0,
            'examinateur'  => 0,
            'etudiant'     => 0
        ];
        // Pour chaque rôle sélectionné, passe à 1
        foreach ($roles as $r) {
            if (array_key_exists($r, $flags)) {
                $flags[$r] = 1;
            }
        }

        // Génération manuelle de l'ID (pas d'AUTO_INCREMENT)
        $newId = self::getNextId('personne');

        $sql = "INSERT INTO personne
            (id, nom, prenom,
             role_responsable, role_examinateur, role_etudiant,
             login, password)
            VALUES
            (:id, :nom, :prenom, :r1, :r2, :r3, :login, :pwd)";
        return self::executeQuery($sql, [
            'id'     => $newId,
            'nom'    => $nom,
            'prenom' => $prenom,
            'r1'     => $flags['responsable'],
            'r2'     => $flags['examinateur'],
            'r3'     => $flags['etudiant'],
            'login'  => $login,
            'pwd'    => $password,
        ]);
    }
    public static function getAllEtudiants(): array
    {
        $sql = "SELECT id, nom, prenom FROM personne WHERE role_etudiant = 1";
        return self::selectAll($sql);
    }
}
