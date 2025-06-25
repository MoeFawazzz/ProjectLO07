<div class="container mt-5">
    <h2>Modifier un créneau</h2>
    <p><strong>Projet :</strong> <?= htmlspecialchars($creneau['projet_label']) ?></p>

    <form method="post" action="<?= $action ?>">
        <div class="mb-3">
            <label for="datetime" class="form-label">Date et heure</label>
            <input type="datetime-local" name="datetime" id="datetime" class="form-control"
                value="<?= date('Y-m-d\TH:i', strtotime($creneau['creneau'])) ?>" required>
        </div>

        <div class="mb-3">
            <label for="etudiant_id" class="form-label">Étudiant assigné</label>
            <select name="etudiant_id" id="etudiant_id" class="form-select">
                <option value="">-- Aucun --</option>
                <?php foreach ($etudiants as $e): ?>
                    <option value="<?= $e['id'] ?>"
                        <?= (isset($creneau['etudiant_id']) && $creneau['etudiant_id'] == $e['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($e['prenom'] . ' ' . $e['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Enregistrer</button>
    </form>
</div>


