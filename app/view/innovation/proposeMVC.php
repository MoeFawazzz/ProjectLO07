<?php
// app/view/innovation/proposeMVC.php
require __DIR__ . '/../fragment/fragmentHeader.html';
require __DIR__ . '/../fragment/fragmentJumbotron.html';
require __DIR__ . '/../fragment/fragmentMenu.php';
?>

<div class="container mt-4 pt-5">
  <h2>Proposition d’amélioration du projet MVC</h2>

  <div class="card mb-4">
    <div class="card-body">
      <h4 class="card-title">
        Standardiser l’autoloading PSR-4 et réorganiser les dossiers par domaine fonctionnel
      </h4>

      <h5>Contexte</h5>
      <p>
        Actuellement, chaque contrôleur, modèle et vue est inclus manuellement via des
        <code>require</code> ou <code>include</code>. Dès que le projet grandit :
      </p>
      <ul>
        <li>Les lignes d’inclusion se multiplient.</li>
        <li>On perd en lisibilité et en cohérence de l’arborescence.</li>
        <li>Le risque d’oublis d’inclusion ou de collisions de noms augmente.</li>
      </ul>

      <h5>Solution proposée</h5>
      <p>
        Adopter le standard <strong>PSR-4</strong> via Composer et organiser vos classes
        dans des namespaces reflétant leur domaine métier. Concrètement :
      </p>
      <ol>
        <li>
          <strong>composer.json</strong>  
          <pre><code>{
  "autoload": {
    "psr-4": {
      "App\\Controller\\": "app/controller/",
      "App\\Model\\":      "app/model/",
      "App\\View\\":       "app/view/"
    }
  }
}</code></pre>
        </li>
        <li>
          Exécuter <code>composer dump-autoload</code> pour générer automatiquement
          <code>vendor/autoload.php</code>.
        </li>
        <li>
          Ajouter le namespace dans chaque classe :
          <pre><code>&lt;?php
namespace App\Controller;

class ControllerProjet {
    public static function listProjets() { /* … */ }
}
</code></pre>
        </li>
        <li>
          Dans <code>public/index.php</code> (front-controller unique) :
          <pre><code>&lt;?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

$action = $_GET['action'] ?? 'index';
[$ctrl, $meth] = explode('-', $action, 2);
// ex. action=listProjets → ['listProjets','']
$controller = 'App\\Controller\\Controller' . ucfirst($ctrl);
if (method_exists($controller, $meth)) {
    call_user_func([ $controller, $meth ]);
} else {
    http_response_code(404);
    echo "Action inconnue";
}
</code></pre>
        </li>
      </ol>

      <h5>Nouvelle arborescence</h5>
      <pre>
mon-projet/
├─ composer.json
├─ public/
│  └─ index.php          ← front-controller unique
├─ vendor/…              ← autoloader Composer
└─ app/
   ├─ controller/        ← App\Controller\
   ├─ model/             ← App\Model\
   └─ view/              ← App\View\
       ├─ fragment/
       └─ innovation/
      </pre>

      <h5>Avantages</h5>
      <ul>
        <li>Plus d’inclusions manuelles : Composer charge automatiquement chaque classe.</li>
        <li>Clarté & découplage : dossiers et namespaces reflètent votre domaine métier.</li>
        <li>Interopérabilité : adoption d’un standard reconnu dans l’écosystème PHP.</li>
        <li>Maintenance & tests : facilite le refactoring, le mock des classes et l’intégration de tests unitaires.</li>
      </ul>

      <a href="index.php?action=index" class="btn btn-secondary mt-3">← Retour</a>
    </div>
  </div>
</div>

<?php
require __DIR__ . '/../fragment/fragmentFooter.html';
