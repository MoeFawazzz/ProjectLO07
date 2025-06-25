<?php
// app/view/responsable/listExaminateurs.php
?>
<div class="container mt-5 pt-5">
  <h2>Examinateurs</h2>
  <?php if (empty($exs)): ?>
    <p>Aucun examinateur.</p>
  <?php else: ?>
    <table class="table">
      <thead><tr><th>ID</th><th>Nom</th><th>Prénom</th></tr></thead>
      <tbody>
      <?php foreach($exs as $e): ?>
        <tr>
          <td><?= $e['id'] ?></td>
          <td><?= htmlspecialchars($e['nom']) ?></td>
          <td><?= htmlspecialchars($e['prenom']) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
