<?php
// app/model/ModelPersonne.php
  require_once __DIR__ . '/Model.php';
  
  class ModelPersonne extends Model
  {
      public static function getByLoginPassword(string $login, string $pwd)
      {
          $sql = "SELECT * FROM personne WHERE login=:login AND password=:pwd";
          return self::selectOne($sql, ['login' => $login, 'pwd' => $pwd]);
      }
  
      public static function insertPersonne(string $nom, string $prenom, string $login, string $password, string $role): bool
      {
          $roles = ['responsable' => 0, 'examinateur' => 0, 'etudiant' => 0];
          if (!array_key_exists($role, $roles)) return false;
          $roles[$role] = 1;
  
          $sql = "INSERT INTO personne
                  (nom,prenom,role_responsable,role_examinateur,role_etudiant,login,password)
                  VALUES
                  (:nom,:prenom,:r1,:r2,:r3,:login,:pwd)";
          return self::executeQuery($sql, [
              'nom'   => $nom,
              'prenom'=> $prenom,
              'r1'    => $roles['responsable'],
              'r2'    => $roles['examinateur'],
              'r3'    => $roles['etudiant'],
              'login' => $login,
              'pwd'   => $password
          ]);
      }
  }
  
  ?>