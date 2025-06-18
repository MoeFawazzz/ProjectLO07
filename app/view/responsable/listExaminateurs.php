<?php require_once(__DIR__ . '/../fragment/fragmentMenu.php'); ?>

<h2 class="my-4">Liste des examinateurs</h2>

<ul class="list-group mb-4">
    <?php foreach ($examinateurs as $examinateur): ?>
        <li class="list-group-item">
            <?= htmlspecialchars($examinateur['prenom']) ?> <?= htmlspecialchars($examinateur['nom']) ?>
            (ID : <?= $examinateur['id'] ?>)
        </li>
    <?php endforeach; ?>
</ul>

<a href="index.php?controller=responsable&action=formAjoutExaminateur" class="btn btn-primary">
    Assigner un examinateur à un projet
</a>

<?php require_once(__DIR__ . '/../fragment/fragmentFooter.php'); ?>
