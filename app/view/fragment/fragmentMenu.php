<?php
// =======================
// app/view/fragmentMenu.php
// =======================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Projet LO07</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=connexion&action=formConnexion">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=connexion&action=formInscription">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=connexion&action=disconnect">Déconnexion</a>
                    </li>
                    <?php if (!empty($_SESSION['role_responsable'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=responsable&action=listProjets">Mes projets</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">