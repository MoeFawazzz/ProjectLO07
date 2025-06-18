<?php require_once(__DIR__ . '/../fragment/fragmentMenu.php'); ?>


<h2 class="my-4">Mes projets</h2>

<ul class="list-group mb-4">
    <?php foreach ($projets as $projet): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= htmlspecialchars($projet['label']) ?>
            <span class="badge bg-secondary">ID : <?= $projet['id'] ?></span>
        </li>
    <?php endforeach; ?>
</ul>

<a href="index.php?controller=responsable&action=formAjoutProjet" class="btn btn-primary">
    Ajouter un projet
</a>

<?php require_once(__DIR__ . '/../fragment/fragmentFooter.php'); ?>