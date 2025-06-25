<!-- app/view/examinateur/formAjoutCreneauxConsecutifs.php -->
<?php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.php';
?>

<div class="container mt-5">
    <h2>Ajouter des créneaux consécutifs</h2>
    <form method="post" action="index.php?controller=examinateur&action=ajoutCreneauxConsecutifs">
        <div class="mb-3">
            <label for="projet_id" class="form-label">Projet</label>
            <select name="projet_id" id="projet_id" class="form-select" required>
                <?php foreach ($projets as $p): ?>
                    <option value="<?= $p['id'] ?>">
                        <?= htmlspecialchars($p['label']) ?> (Groupe <?= $p['groupe'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="heure" class="form-label">Heure de début</label>
            <input type="time" name="heure" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nb" class="form-label">Nombre de créneaux (1 à 10)</label>
            <input type="number" name="nb" class="form-control" min="1" max="10" required>
        </div>

        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>

<?php require __DIR__ . '/../fragment/fragmentFooter.html'; ?>
