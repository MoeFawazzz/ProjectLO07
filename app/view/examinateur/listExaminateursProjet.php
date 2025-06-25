<!-- app/view/examinateur/listExaminateursProjet.php -->
<?php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.php';
?>

<div class="container mt-5">
    <h2>Examinateurs affectés à ce projet</h2>
    <?php if (empty($exs)): ?>
        <p class="text-muted">Aucun examinateur n'est encore affecté à ce projet.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($exs as $exam): ?>
                <li class="list-group-item">
                    <?= htmlspecialchars($exam['prenom'] . ' ' . $exam['nom']) ?> (ID: <?= $exam['examinateur_id'] ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../fragment/fragmentFooter.html'; ?>
