<?php
// app/view/innovation/proposeFeature.php
?>

<div class="container mt-4 pt-5">
  <h2>Proposez une fonctionnalité originale</h2>
  <p>Dans cette section, partagez votre idée de fonctionnalité inédite pour améliorer l’expérience utilisateur ou la maintenabilité de notre application de soutenances.</p>

  <div class="card mb-5">
<div class="card-body bg-light">
  <h5 class="card-title">Sujet :</h5>
  <p class="card-text">
    Une fonctionnalité clé déjà mise en œuvre dans notre application est la gestion complète des créneaux par les examinateurs, illustrant un cycle CRUD complet :
  </p>
  <ul>
    <li>
      <strong>Créer :</strong> les examinateurs peuvent ajouter des créneaux manuellement via un formulaire (action <code>formAjoutCreneau</code>), ou automatiquement sous forme de créneaux consécutifs via <code>ajoutCreneauxConsecutifs</code>. Les données sont insérées dans la base via <code>ModelExaminateur::insertCreneau</code>.
    </li>
    <li>
      <strong>Lire :</strong> ils peuvent consulter l’ensemble de leur planning grâce à <code>ControllerExaminateur::planning()</code> qui appelle <code>ModelProjet::getCreneauxByExaminateur()</code>, puis affiche la vue <code>planningTout</code>.
    </li>
    <li>
      <strong>Mettre à jour :</strong> un formulaire pré-rempli est affiché avec <code>formEditCreneau</code>, puis la mise à jour s’effectue avec <code>editCreneau()</code> qui appelle le modèle <code>updateCreneau()</code>.
    </li>
    <li>
      <strong>Supprimer :</strong> la suppression d’un créneau se fait via <code>deleteCreneau()</code>, qui appelle <code>ModelExaminateur::deleteCreneauById()</code>.
    </li>
  </ul>

  <p>Chaque opération suit le schéma MVC :</p>
  <ul>
    <li><strong>Modèle</strong> : accède à la base de données avec des fonctions spécifiques dans <code>ModelExaminateur</code> et <code>ModelProjet</code> ;</li>
    <li><strong>Contrôleur</strong> : vérifie l’authentification, traite les données et appelle les bonnes vues ;</li>
    <li><strong>Vue</strong> : utilise <code>View::render()</code> pour afficher dynamiquement les formulaires et résultats, avec Bootstrap pour l’UI.</li>
  </ul>

  <p>
    Cette architecture rend le code modulaire, maintenable et facile à étendre avec des fonctionnalités futures comme l’attribution automatique d’étudiants ou des notifications de rappel.
  </p>
</div>

  </div>

  <!-- Ici éventuellement un <form> si vous souhaitez la déposer en base plus tard -->

  <a href="index.php?action=index" class="btn btn-secondary">← Retour</a>
</div>