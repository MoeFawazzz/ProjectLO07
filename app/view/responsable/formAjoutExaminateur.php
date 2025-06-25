<?php
// app/view/responsable/formAjoutExaminateur.php
?>
<div class="container mt-5 pt-5">
  <h2>Ajouter un examinateur</h2>
  <form method="post" action="index.php?controller=responsable&action=ajoutExaminateur">
    <div class="mb-3">
      <label for="nom" class="form-label">Nom</label>
      <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="mb-3">
      <label for="prenom" class="form-label">Prénom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" required>
    </div>
    <button type="submit" class="btn btn-success">Créer</button>
  </form>
</div>

