<?php
// app/view/rdv/listRdvs.php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.php';
?>
<div class="container mt-5 pt-5">
  <h2>Liste des rendez-vous</h2>
  <?php if (empty($rdvs)): ?>
    <div class="alert alert-info">Aucun rendez-vous trouvé.</div>
  <?php else: ?>
    <table class="table table-striped table-hover mt-3">
      <thead class="table-dark">
        <tr>
          <?php foreach (array_keys($rdvs[0]) as $col): ?>
            <th><?= htmlspecialchars($col) ?></th>
          <?php endforeach; ?>
          <th>Détails</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rdvs as $r): ?>
          <tr>
            <?php foreach ($r as $value): ?>
              <td><?= htmlspecialchars($value) ?></td>
            <?php endforeach; ?>
            <td>
              <a href="index.php?action=detailRdv&id=<?= urlencode($r['rdv_id']) ?>"
                 class="btn btn-sm btn-primary">
                Voir
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<?php require __DIR__ . '/../fragment/fragmentFooter.html'; ?>
