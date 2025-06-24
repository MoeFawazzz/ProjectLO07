<?php
// app/view/responsable/listExaminateursProjet.php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.php';
?>
<div class="container mt-4 pt-5">
  <h2>Examinateurs du projet sélectionné</h2>
  <?php if (empty($exs)): ?>
    <div class="alert alert-info">Aucun examinateur pour ce projet.</div>
  <?php else: ?>
    <ul class="list-group">
      <?php foreach ($exs as $e): ?>
        <li class="list-group-item">
          <?= htmlspecialchars($e['nom'] . ' ' . $e['prenom']) ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <a href="index.php?action=listProjets" class="btn btn-secondary mt-3">Retour</a>
</div>
<?php require __DIR__ . '/../fragment/fragmentFooter.html'; ?>
