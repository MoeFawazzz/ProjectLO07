<?php
// Ne pas oublier : index.php est votre point d'entrée, 
// on veut ici forcer la déconnexion par défaut.
session_start();

// Si on arrive **sans** paramètre d'action, 
// on considère que c'est un "démarrage à froid" et on vide la session.
if (!isset($_GET['action'])) {
    $_SESSION['login_id']    = 0;
    $_SESSION['login_prenom'] = '';
    $_SESSION['login_nom']    = '';
}

// Maintenant, on appelle le routeur normalement
require __DIR__ . '/app/routeur/routeur.php';
