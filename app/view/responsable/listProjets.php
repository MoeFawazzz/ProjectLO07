<?php
// app/view/responsable/listProjets.php
?>
<div class="container mt-4 pt-5">
  <h2>Mes projets</h2>
  <?php if (empty($prs)): ?>
    <div class="alert alert-info">Aucun projet.</div>
  <?php else: ?>
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Label</th>
          <th>Groupe</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($prs as $p): ?>
          <tr>
            <td><?= htmlspecialchars($p['id']) ?></td>
            <td><?= htmlspecialchars($p['label']) ?></td>
            <td><?= htmlspecialchars($p['groupe']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
