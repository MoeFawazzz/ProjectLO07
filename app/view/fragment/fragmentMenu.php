<?php
echo '<nav>';
if (!isset($_SESSION['login_id'])) {
    echo '<a href="index.php?controller=connexion&action=formConnexion">Connexion</a> | ';
    echo '<a href="index.php?controller=connexion&action=formInscription">Inscription</a>';
} else {
    echo 'Connecté : ' . $_SESSION['login_prenom'] . ' ' . $_SESSION['login_nom'] . ' | ';
    echo '<a href="index.php?controller=connexion&action=logout">Déconnexion</a> | ';
    if ($_SESSION['role_responsable']) {
        echo '<a href="index.php?controller=responsable&action=listProjets">Mes projets</a>';
    }
}
echo '</nav>';
