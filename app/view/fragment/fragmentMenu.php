<?php
// app/view/fragment/fragmentMenu.php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$loggedIn = !empty($_SESSION['login_id']);
$prenom   = $_SESSION['login_prenom'] ?? '';
$nom      = $_SESSION['login_nom']    ?? '';
?>
<nav class="navbar navbar-expand-lg bg-success fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="index.php?action=index">
      DANGUILLAUME-FAWAZ
    </a>

    <?php if ($loggedIn): ?>
      <span class="navbar-text text-white ms-3">
        <?= htmlspecialchars($prenom . ' ' . $nom) ?>
      </span>
    <?php endif; ?>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto">

        <?php if ($loggedIn && $_SESSION['role_responsable']): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
              Responsable
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="index.php?action=listProjets">Liste des projets</a></li>
              <li><a class="dropdown-item" href="index.php?action=formAjoutProjet">Ajout d'un projet</a></li>
              <li><a class="dropdown-item" href="index.php?action=listExaminateurs">Liste des examinateurs</a></li>
              <li><a class="dropdown-item" href="index.php?action=formAjoutExaminateur">Ajout d'un examinateur</a></li>
              <li><a class="dropdown-item" href="index.php?action=listExaminateursProjet">Liste des examinateurs d'un projet</a></li>
              <li><a class="dropdown-item" href="index.php?action=planningProjet">Planning d'un projet</a></li>
            </ul>
          </li>
        <?php endif; ?>

        <?php if ($loggedIn && $_SESSION['role_examinateur']): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
            Examinateur
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?controller=examinateur&action=listProjetsExam">Liste des projets</a></li>
           <li><a class="dropdown-item" href="index.php?controller=examinateur&action=planning">Liste complète de mes créneaux</a></li>
           <li><a class="dropdown-item" href="index.php?controller=examinateur&action=formSelectProjetCreneaux">Liste de mes créneaux pour un projet</a></li>
           <li><a class="dropdown-item" href="index.php?controller=examinateur&action=formAjoutCreneau">Ajouter un créneau à un projet</a></li>
           <li><a class="dropdown-item" href="index.php?controller=examinateur&action=formAjoutCreneauxConsecutifs">Ajouter des créneaux consécutifs</a></li>


          </ul>
        </li>
        <?php endif; ?>

        <?php if ($loggedIn && $_SESSION['role_etudiant']): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
              Étudiant
            </a>
            <ul class="dropdown-menu">
              <a class="dropdown-item" href="index.php?controller=etudiant&action=listRdvs">Liste de mes RDV</a>
              <li><a class="dropdown-item" href="index.php?controller=etudiant&action=formPrendreRdv">Prendre un RDV pour un projet</a></li>

            </ul>
          </li>
        <?php endif; ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
            Innovations
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?action=proposeFeature">Proposez une fonctionnalité originale</a></li>
            <li><a class="dropdown-item" href="index.php?action=proposeMVC">Proposez une amélioration MVC</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
            Se connecter
          </a>
          <ul class="dropdown-menu">
            <?php if (!$loggedIn): ?>
              <li><a class="dropdown-item" href="index.php?action=formConnexion">Login</a></li>
              <li><a class="dropdown-item" href="index.php?action=formInscription">Sign up</a></li>
            <?php else: ?>
              <li><a class="dropdown-item" href="index.php?action=logout">Log out</a></li>
            <?php endif; ?>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>