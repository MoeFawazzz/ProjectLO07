<?php require_once(__DIR__ . '/../fragment/fragmentMenu.php'); ?>

<h2 class="my-4">Sélection d'un projet</h2>

<form method="post" action="">
    <div class="mb-3">
        <label for="idProjet" class="form-label">Choisir un projet :</label>
        <select name="idProjet" id="idProjet" class="form-select">
            <?php foreach ($projets as $p): ?>
                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['label']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Voir</button>
</form>

<?php require_once(__DIR__ . '/../fragment/fragmentFooter.php'); ?>
