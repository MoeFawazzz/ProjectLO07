<?php require_once(__DIR__ . '/../fragment/fragmentMenu.php'); ?>

<h2 class="my-4">Planning du projet</h2>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>Étudiant</th>
            <th>Horaire</th>
            <th>Examinateur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rdvs as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r['etudiant_prenom']) ?> <?= htmlspecialchars($r['etudiant_nom']) ?></td>
                <td><?= htmlspecialchars($r['creneau']) ?></td>
                <td><?= htmlspecialchars($r['examinateur_prenom']) ?> <?= htmlspecialchars($r['examinateur_nom']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once(__DIR__ . '/../fragment/fragmentFooter.php'); ?>
