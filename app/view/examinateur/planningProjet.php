<!-- app/view/examinateur/planningProjet.php -->

<div class="container mt-5">
    <h2>Planning du projet: <?= htmlspecialchars($proj['label']) ?></h2>

    <?php if (empty($rvs)): ?>
        <p class="text-muted">Aucun rendez-vous planifié pour ce projet.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Examinateur</th>
                    <th>Date et heure</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rvs as $rdv): ?>
                    <tr>
                        <td><?= htmlspecialchars($rdv['etudiant_prenom'] . ' ' . $rdv['etudiant_nom']) ?></td>
                        <td><?= htmlspecialchars($rdv['examinateur_prenom'] . ' ' . $rdv['examinateur_nom']) ?></td>
                        <td><?= htmlspecialchars($rdv['creneau']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
