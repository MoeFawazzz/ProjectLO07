<?php
// app/view/examinateur/planningTout.php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.php';
?>

<div class="container mt-5">
    <h2>Mes créneaux d'examen</h2>

    <?php if (empty($creneaux)): ?>
        <p class="text-muted">Aucun créneau trouvé.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID créneau</th>
                    <th>Projet</th>
                    <th>Date et heure</th>
                    <th>Étudiant assigné</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($creneaux as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['creneau_id']) ?></td>
                        <td><?= htmlspecialchars($c['label']) ?></td>
                        <td><?= htmlspecialchars($c['creneau']) ?></td>
                        <td>
                            <?php if (!empty($c['etudiant_nom'])): ?>
                                <?= htmlspecialchars($c['etudiant_prenom'] . ' ' . $c['etudiant_nom']) ?>
                            <?php else: ?>
                                <em>Non attribué</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../fragment/fragmentFooter.html'; ?>
