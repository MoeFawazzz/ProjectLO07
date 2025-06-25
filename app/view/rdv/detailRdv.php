<?php
// app/view/rdv/detailRdv.php
?>
<div class="container mt-5 pt-5">
  <?php if (empty($rdv)): ?>
    <div class="alert alert-warning">Rendez-vous introuvable.</div>
  <?php else: ?>
    <h2>Détails du rendez-vous #<?= htmlspecialchars($rdv['rdv_id']) ?></h2>
    <ul class="list-group mt-3">
      <?php foreach ($rdv as $key => $val): ?>
        <li class="list-group-item">
          <strong><?= htmlspecialchars($key) ?> :</strong>
          <?= htmlspecialchars($val) ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <a href="index.php?action=listRdvs" class="btn btn-secondary mt-3">Retour</a>
  <?php endif; ?>
</div>
