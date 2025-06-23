<?php
// app/view/responsable/formAjoutProjet.php
require __DIR__ . '/../../view/fragment/fragmentMenu.html';
?>
<div class="container mt-5 pt-5">
  <h2>Ajouter un projet</h2>
  <form method="post" action="index.php?controller=responsable&action=ajoutProjet">
    <div class="mb-3">
      <label for="label" class="form-label">Intitulé du projet</label>
      <input type="text" class="form-control" id="label" name="label" required>
    </div>
    <div class="mb-3">
      <label for="groupe" class="form-label">Nombre d’étudiants (1–5)</label>
      <input type="number" class="form-control" id="groupe" name="groupe" min="1" max="5" required>
    </div>
    <button type="submit" class="btn btn-success">Créer</button>
  </form>
</div>

<?php require __DIR__ . '/../fragment/fragmentFooter.php'; ?>
