<?php
// app/view/responsable/planningProjet.php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.php';
?>
<div class="container mt-5 pt-5">
  <h2>Planning du projet</h2>
  <?php if (empty($rvs)): ?>
    <p>Aucun créneau programmé.</p>
  <?php else: ?>
    <table class="table">
      <thead><tr><th>Date</th><th>Heure</th><th>Examinateur</th></tr></thead>
      <tbody>
      <?php foreach($rvs as $c): ?>
        <tr>
          <td><?= htmlspecialchars($c['date']) ?></td>
          <td><?= htmlspecialchars($c['heure']) ?></td>
          <td><?= htmlspecialchars($c['examPrenom'] . ' ' . $c['examNom']) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../fragment/fragmentFooter.html'; ?>
