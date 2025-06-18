<h2>Mes projets</h2>
<ul>
<?php foreach ($projets as $projet): ?>
    <li><?= htmlspecialchars($projet['label']) ?> (ID: <?= $projet['id'] ?>)</li>
<?php endforeach; ?>
</ul>
<a href="index.php?controller=responsable&action=formAjoutProjet">Ajouter un projet</a>


// =======================
// app/view/responsable/formAjoutProjet.php
// =======================

<h2>Ajouter un projet</h2>
<form method="post" action="index.php?controller=responsable&action=ajoutProjet">
    <label>Label du projet :</label>
    <input type="text" name="label" required>
    <input type="submit" value="Créer">
</form>