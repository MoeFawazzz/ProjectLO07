<?php
require_once 'app/model/Model.php';

class ModelUser
{
    public static function getByLogin($login)
    {
        try {
            $pdo = Model::getPDO();
            $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->execute([':username' => $login]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // returns false if no match
        } catch (PDOException $e) {
            // Optionally log error
            return null;
        }
    }

    public static function registerUser($nom, $prenom, $login, $password, $role)
    {
        try {
            $pdo = Model::getPDO();

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert into user table
            $stmt = $pdo->prepare("INSERT INTO user (username, password, email, role) 
                                   VALUES (:username, :password, NULL, :role)");
            $stmt->execute([
                ':username' => $login,
                ':password' => $hashedPassword,
                ':role' => $role
            ]);

            // Insert into personne table
            $idStmt = $pdo->query("SELECT IFNULL(MAX(id), 0) + 1 AS next_id FROM personne");
            $nextId = $idStmt->fetch()['next_id'];

            $stmt = $pdo->prepare("INSERT INTO personne (id, nom, prenom, role_responsable, role_examinateur, role_etudiant, login, password)
                                   VALUES (:id, :nom, :prenom, :role_responsable, :role_examinateur, :role_etudiant, :login, :password)");
            $stmt->execute([
                ':id' => $nextId,
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':role_responsable' => ($role === 'responsable') ? 1 : 0,
                ':role_examinateur' => ($role === 'examinateur') ? 1 : 0,
                ':role_etudiant' => ($role === 'etudiant') ? 1 : 0,
                ':login' => $login,
                ':password' => $password
            ]);

            return ['success' => true];

        } catch (PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
