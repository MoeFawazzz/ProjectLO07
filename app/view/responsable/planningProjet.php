<h2>Planning du projet</h2>
<table border="1">
    <tr>
        <th>Étudiant</th>
        <th>Horaire</th>
        <th>Examinateur</th>
    </tr>
    <?php foreach ($rdvs as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['etudiant_prenom']) ?> <?= htmlspecialchars($r['etudiant_nom']) ?></td>
            <td><?= htmlspecialchars($r['horaire']) ?></td>
            <td><?= htmlspecialchars($r['examinateur_prenom']) ?> <?= htmlspecialchars($r['examinateur_nom']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
