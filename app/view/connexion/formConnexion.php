<?php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.php';
?>

<h2 class="my-4">Connexion</h2>

<form method="post" action="index.php?action=login" class="mb-4">
    <div class="mb-3">
        <label for="login" class="form-label">Login :</label>
        <input type="text" name="login" id="login" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe :</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php require __DIR__ . '/../fragment/fragmentFooter.php'; ?>