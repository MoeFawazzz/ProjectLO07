<?php require_once(__DIR__ . '/../fragment/fragmentMenu.php'); ?>


<h2 class="my-4">Ajouter un projet</h2>

<form method="post" action="index.php?controller=responsable&action=ajoutProjet" class="mb-4">
    <div class="mb-3">
        <label for="label" class="form-label">Label du projet :</label>
        <input type="text" id="label" name="label" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Créer</button>
</form>

<?php require_once(__DIR__ . '/../fragment/fragmentFooter.php'); ?>
