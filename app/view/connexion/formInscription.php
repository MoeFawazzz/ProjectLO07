<?php
// app/view/connexion/formInscription.php
?>
<div class="container mt-4 pt-5">
  <h2>Inscription</h2>
  <?php if (!empty($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
      <?= htmlspecialchars($_SESSION['error_message']) ?>
    </div>
  <?php unset($_SESSION['error_message']); endif; ?>

  <form action="index.php?action=register" method="post">
    <div class="mb-3">
      <label for="nom" class="form-label">Nom</label>
      <input type="text" id="nom" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="prenom" class="form-label">Prénom</label>
      <input type="text" id="prenom" name="prenom" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="login" class="form-label">Login</label>
      <input type="text" id="login" name="login" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="role" class="form-label">Rôle</label>
      <select id="role" name="role" class="form-select" required>
        <option value="responsable">Responsable</option>
        <option value="examinateur">Examinateur</option>
        <option value="etudiant">Étudiant</option>
      </select>
    </div>
    <button type="submit" class="btn btn-success">S'inscrire</button>
  </form>
</div>
