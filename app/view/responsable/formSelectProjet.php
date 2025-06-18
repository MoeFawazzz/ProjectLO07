<h2>Sélection d'un projet</h2>
<form method="post" action="">
    <label>Choisir un projet :</label>
    <select name="idProjet">
        <?php foreach ($projets as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['label']) ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Voir">
</form>