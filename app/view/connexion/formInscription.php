<?php
// app/view/connexion/formInscription.php
?>

<div class="container mt-4 pt-5">
  <h2>Inscription</h2>
  <?php if (!empty($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
      <?= htmlspecialchars($_SESSION['error_message']) ?>
      <?php unset($_SESSION['error_message']); ?>
    </div>
  <?php endif; ?>

  <form action="index.php?action=register" method="post">
    <div class="mb-3">
      <label for="nom" class="form-label">Nom</label>
      <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="mb-3">
      <label for="prenom" class="form-label">Prénom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" required>
    </div>
    <div class="mb-3">
      <label for="login" class="form-label">Login</label>
      <input type="text" class="form-control" id="login" name="login" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Rôles <small>(plusieurs possibles)</small></label>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="roles[]" id="roleResp" value="responsable">
        <label class="form-check-label" for="roleResp">Responsable</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="roles[]" id="roleExam" value="examinateur">
        <label class="form-check-label" for="roleExam">Examinateur</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="roles[]" id="roleEtu" value="etudiant">
        <label class="form-check-label" for="roleEtu">Étudiant</label>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">S’inscrire</button>
  </form>
</div>
