<?php
// app/view/rdv/listRdvs.php
?>
<div class="container mt-5 pt-5">
  <h2>Liste des rendez-vous</h2>
  <?php if (empty($rdvs)): ?>
    <div class="alert alert-info">Aucun rendez-vous trouvé.</div>
  <?php else: ?>
    <?php
      // Colonnes à masquer
      $hide = ['rdv_id','projet_id','examinateur_id','creneau_id','etudiant_id'];
      // On garde dans $cols toutes les autres colonnes
      $cols = array_filter(
        array_keys($rdvs[0]),
        function($c) use($hide){ return !in_array($c, $hide); }
      );
    ?>
    <table class="table table-striped table-hover mt-3">
      <thead class="table-dark">
        <tr>
          <?php foreach($cols as $col): ?>
            <th><?= htmlspecialchars($col) ?></th>
          <?php endforeach; ?>
          <th>Détails</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($rdvs as $r): ?>
          <tr>
            <?php foreach($cols as $col): ?>
              <td><?= htmlspecialchars($r[$col]) ?></td>
            <?php endforeach; ?>
            <td>
              <?php $id = isset($r['rdv_id']) ? (string)$r['rdv_id'] : ''; ?>
              <a
                href="index.php?action=detailRdv<?= $id !== '' ? '&id=' . rawurlencode($id) : '' ?>"
                class="btn btn-sm btn-primary"
              >Voir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
