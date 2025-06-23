<?php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.html';
?>

<h2 class="my-4">Inscription</h2>

<form method="post" action="index.php?action=register" class="mb-4">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom :</label>
        <input type="text" name="nom" id="nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom :</label>
        <input type="text" name="prenom" id="prenom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="login" class="form-label">Login :</label>
        <input type="text" name="login" id="login" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe :</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Rôle :</label>
        <select name="role" id="role" class="form-select">
            <option value="responsable">Responsable</option>
            <option value="examinateur">Examinateur</option>
            <option value="etudiant">Étudiant</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">S'inscrire</button>
</form>

<?php require __DIR__ . '/../fragment/fragmentFooter.php'; ?>
