<?php
// app/view/responsable/listProjets.php
require __DIR__ . '/../../view/fragment/fragmentMenu.php';
?>
<div class="container mt-5 pt-5">
  <h2>Mes projets</h2>
  <?php if (empty($prs)): ?>
    <p>Aucun projet.</p>
  <?php else: ?>
    <table class="table">
      <thead><tr><th>ID</th><th>Label</th><th>Groupe</th></tr></thead>
      <tbody>
      <?php foreach($prs as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['label']) ?></td>
          <td><?= $p['groupe'] ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
