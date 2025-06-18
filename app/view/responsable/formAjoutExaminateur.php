<h2>Assigner un examinateur</h2>
<form method="post" action="index.php?controller=responsable&action=ajoutExaminateur">
    <label>Projet :</label>
    <select name="idProjet">
        <?php foreach ($projets as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['label']) ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Examinateur :</label>
    <select name="idExaminateur">
        <?php foreach ($examinateurs as $e): ?>
            <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['prenom']) ?> <?= htmlspecialchars($e['nom']) ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Créneau :</label>
    <input type="text" name="creneau" placeholder="Ex : Lundi 10h"><br>

    <input type="submit" value="Assigner">
</form>