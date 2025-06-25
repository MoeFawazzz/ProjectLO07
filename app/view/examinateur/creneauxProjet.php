<?php
// require __DIR__ . '/../fragment/fragmentHeader.html';
// require __DIR__ . '/../fragment/fragmentJumbotron.html';
// require __DIR__ . '/../fragment/fragmentMenu.php';
?>

<div class="container mt-5">
    <h2>Créneaux pour le projet : <?= htmlspecialchars($proj['label']) ?></h2>

    <?php if (empty($creneaux)): ?>
        <p class="text-muted">Aucun créneau trouvé pour ce projet.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date & Heure</th>
                    <th>Étudiants</th>
                </tr>
            </thead>
        
            <tbody>
                <?php foreach ($creneaux as $cr): ?>
                    <tr>
                        <td><?= htmlspecialchars($cr['creneau']) ?></td>
                        <td><?= htmlspecialchars($cr['etudiant_prenom'] . ' ' . $cr['etudiant_nom']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

