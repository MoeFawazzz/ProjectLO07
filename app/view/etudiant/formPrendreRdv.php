<div class="container mt-5">
    <h2>Réserver un rendez-vous</h2>
    <form method="post" action="index.php?controller=etudiant&action=prendreRdv">
        <div class="mb-3">
            <label for="creneau_id" class="form-label">Créneau disponible</label>
            <select name="creneau_id" id="creneau_id" class="form-select" required>
                <option value="">-- Choisir un créneau --</option>
                <?php foreach ($creneaux as $c): ?>
                    <option value="<?= $c['creneau_id'] ?>">
                        <?= htmlspecialchars($c['projet_label']) ?> - <?= htmlspecialchars($c['creneau']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Réserver</button>
    </form>
</div>
