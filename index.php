<?php
require_once 'app/view/fragment/fragmentMenu.php';
require_once 'app/routeur/routeur.php'
?>

<div class="text-center mt-5">
    <h1 class="mb-4">Bienvenue sur le projet de soutenances LO07</h1>
    <p class="lead">Connectez-vous pour gérer vos projets, consulter les plannings, ou vous inscrire selon votre rôle.</p>
    <div class="mt-4">
        <a href="index.php?controller=connexion&action=formConnexion" class="btn btn-primary me-2">Connexion</a>
        <a href="index.php?controller=connexion&action=formInscription" class="btn btn-outline-secondary">Inscription</a>
    </div>
</div>

<?php
require_once 'app/view/fragment/fragmentFooter.php';
?>
