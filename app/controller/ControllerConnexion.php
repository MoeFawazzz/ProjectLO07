<?php
require_once 'app/model/ModelPersonne.php';

class ControllerConnexion
{

    public static function formConnexion()
    {
        require 'app/view/connexion/formConnexion.php';
    }

  public static function connect()
{
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    require_once 'app/model/ModelUser.php';

    $user = ModelUser::getByLogin($login);

    if ($user && password_verify($password, $user['password'])) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Optionally fetch more details from personne table if needed
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header('Location: index.php?controller=responsable&action=listProjets');
        exit();
    } else {
        $message = "<p>Erreur de connexion : identifiants invalides.</p>";
        require 'app/view/connexion/formConnexion.php';
    }
}



    public static function logout()
    {
        session_destroy();
        header('Location: index.php');
    }

    public static function formInscription()
    {
        require 'app/view/connexion/formInscription.php';
    }

  public static function register()
{
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if (empty($nom) || empty($prenom) || empty($login) || empty($password) || empty($role)) {
        $message = "All fields are required.";
        require 'app/view/connexion/formInscription.php';
        return;
    }

    require_once 'app/model/ModelUser.php';

    $result = ModelUser::registerUser($nom, $prenom, $login, $password, $role);

    if ($result['success']) {
        $message = "Registration successful! <a href='index.php?controller=connexion&action=formConnexion'>Login</a>";
    } else {
        $message = "Registration failed: " . htmlspecialchars($result['error']);
    }

    require 'app/view/connexion/formInscription.php';
}

}
