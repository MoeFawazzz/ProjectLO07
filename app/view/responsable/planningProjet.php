<?php
// app/view/responsable/planningProjet.php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.php';
?>
<div class="container mt-4 pt-5">
  <h2>
    Planning du projet 
    <em><?= htmlspecialchars($proj['label']) ?></em> 
    (Groupe <?= htmlspecialchars($proj['groupe']) ?>)
  </h2>

  <?php if (empty($rvs)): ?>
    <div class="alert alert-info">Aucun créneau pour ce projet.</div>
  <?php else: ?>
    <table class="table table-striped table-hover mt-3">
      <thead class="table-dark">
        <tr>
          <th>Date & Heure</th>
          <th>Examinateur</th>
          <th>Étudiants</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rvs as $row):
            // Séparer date & heure
            $dt   = new DateTime($row['datetime']);
            $date = $dt->format('Y-m-d');
            $time = $dt->format('H:i');
        ?>
          <tr>
            <td><?= htmlspecialchars("$date $time") ?></td>
            <td><?= htmlspecialchars($row['examinateur']) ?></td>
            <td><?= htmlspecialchars($row['etudiants'] ?? '') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <a href="index.php?action=listProjets" class="btn btn-secondary mt-3">← Retour</a>
</div>
<?php require __DIR__ . '/../fragment/fragmentFooter.html'; ?>
