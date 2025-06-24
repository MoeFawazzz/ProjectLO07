<!-- app/view/fragment/fragmentMenu.html -->
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?action=listRdvs">LO07 Soutenances</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto ms-3">
        <li class="nav-item">
          <span class="navbar-text text-white">DANGUILLAUME / FAWAZ</span>
        </li>
        <?php if (isset($_SESSION['login_id'])): ?>
          <li class="nav-item ms-3">
            <span class="navbar-text text-white">
              <?= htmlspecialchars($_SESSION['login_prenom'] . ' ' . $_SESSION['login_nom']) ?>
            </span>
          </li>
          <?php if (!empty($_SESSION['role_responsable'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Responsable</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php?action=listProjets">Mes projets</a></li>
                <li><a class="dropdown-item" href="index.php?action=formAjoutProjet">Ajouter projet</a></li>
                <li><a class="dropdown-item" href="index.php?action=listExaminateurs">Tous examinateurs</a></li>
                <li><a class="dropdown-item" href="index.php?action=formAjoutExaminateur">Ajouter examinateur</a></li>
                <li><a class="dropdown-item" href="index.php?action=listExaminateursProjet">Examinateurs d’un projet</a></li>
                <li><a class="dropdown-item" href="index.php?action=planningProjet">Planning projet</a></li>
              </ul>
            </li>
          <?php endif; ?>
          <?php if (!empty($_SESSION['role_examinateur'])): ?>
            <li class="nav-item"><a class="nav-link" href="#">Examinateur</a></li>
          <?php endif; ?>
          <?php if (!empty($_SESSION['role_etudiant'])): ?>
            <li class="nav-item"><a class="nav-link" href="#">Étudiant</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="index.php?action=logout">Déconnexion</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="index.php?action=formConnexion">Connexion</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?action=formInscription">Inscription</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link" href="index.php?action=listRdvs">RDV</a></li>
      </ul>
    </div>
  </div>
</nav>