<?php require __DIR__ . '/../fragment/fragmentHeader.html'; ?>
<?php require __DIR__ . '/../fragment/fragmentJumbotron.html'; ?>
<?php require __DIR__ . '/../fragment/fragmentMenu.php'; ?>

<div class="container mt-5">
    <h2>Ajouter un créneau</h2>
    <form method="post" action="<?= $action ?>">
        <div class="mb-3">
            <label for="projet_id" class="form-label">Projet</label>
            <select name="projet_id" id="projet_id" class="form-select" required>
                <?php foreach ($prs as $projet): ?>
                    <option value="<?= $projet['id'] ?>"><?= htmlspecialchars($projet['label']) ?> (Groupe <?= $projet['groupe'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="datetime" class="form-label">Date et heure</label>
            <input type="datetime-local" name="datetime" id="datetime" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php require __DIR__ . '/../fragment/fragmentFooter.html'; ?>
