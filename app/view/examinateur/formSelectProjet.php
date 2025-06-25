<!-- app/view/examinateur/formSelectProjet.php -->

<div class="container mt-5">
    <h2>Sélectionner un projet</h2>
    <form method="post" action="<?= $action ?>">
        <div class="mb-3">
            <label for="projet_id" class="form-label">Projet</label>
            <select name="projet_id" id="projet_id" class="form-select" required>
                <?php foreach ($prs as $projet): ?>
                    <option value="<?= $projet['id'] ?>">
                        <?= htmlspecialchars($projet['label']) ?> (Groupe <?= $projet['groupe'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Voir</button>
    </form>
</div>
