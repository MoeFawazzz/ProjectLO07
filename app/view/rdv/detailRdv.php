<?php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.html';
?>
<div class="container mt-5 pt-5">
    <?php if (empty($rdv)): ?>
        <p>Rendez-vous introuvable.</p>
    <?php else: ?>
        <h2>Détails du rendez-vous #<?= htmlspecialchars($rdv['id']) ?></h2>
        <ul class="list-group">
            <?php foreach ($rdv as $k => $v): ?>
                <li class="list-group-item"><strong><?= htmlspecialchars($k) ?>:</strong> <?= htmlspecialchars($v) ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="index.php?action=listRdvs" class="btn btn-secondary mt-3">Retour</a>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../fragment/fragmentFooter.php'; ?>