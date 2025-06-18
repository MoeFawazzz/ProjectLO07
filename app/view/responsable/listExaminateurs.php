<h2>Liste des examinateurs</h2>
<ul>
<?php foreach ($examinateurs as $examinateur): ?>
    <li><?= htmlspecialchars($examinateur['prenom']) ?> <?= htmlspecialchars($examinateur['nom']) ?> (ID: <?= $examinateur['id'] ?>)</li>
<?php endforeach; ?>
</ul>
<a href="index.php?controller=responsable&action=formAjoutExaminateur">Assigner un examinateur à un projet</a>

