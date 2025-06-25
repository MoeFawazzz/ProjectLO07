<?php
// app/view/connexion/formConnexion.php
?>
<div class="container mt-4 pt-5">
  <h2>Connexion</h2>
  <?php if (!empty($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
      <?= htmlspecialchars($_SESSION['error_message']) ?>
    </div>
  <?php unset($_SESSION['error_message']); endif; ?>

  <form action="index.php?action=login" method="post">
    <div class="mb-3">
      <label for="login" class="form-label">Login</label>
      <input type="text" id="login" name="login" class="form-control" required autofocus>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
  </form>
</div>
