<?php
// app/view/innovation/proposeMVC.php
?>

<div class="container mt-4 pt-5">
  <h2>Proposition d’amélioration du projet MVC</h2>

  <div class="card mb-4">
    <div class="card-body">

      <h4 class="card-title">
        Centraliser le rendu des vues via une classe View::render()
      </h4>

      <h5>Contexte</h5>
      <p>
        Jusqu’à présent, chaque contrôleur répétait manuellement les inclusions des fragments :
      </p>
      <pre><code class="language-php">&lt;?php
require __DIR__ . '/../view/fragment/fragmentHeader.html';
require __DIR__ . '/../view/fragment/fragmentJumbotron.html';
require __DIR__ . '/../view/fragment/fragmentMenu.php';
require __DIR__ . '/../view/fragment/fragmentFooter.html';
</code></pre>
      <p>
        Cette duplication alourdit les contrôleurs, multiplie les risques d’oubli et rend le code moins lisible.
      </p>

      <h5>Solution proposée</h5>
      <p>
        Créer une classe utilitaire <code>View</code> qui encapsule tout le layout (header, jumbotron, menu, footer)
        et n’apparaît qu’en un seul appel :
      </p>
      <pre><code class="language-php">&lt;?php
View::render('innovation/proposeMVC');
</code></pre>
      <p>
        Les contrôleurs se concentrent ainsi uniquement sur la logique métier et la récupération des données.
      </p>

      <h5>Implémentation</h5>
      <ol>
        <li>
          <strong>Créer</strong> <code>app/core/View.php</code> :
          <pre><code class="language-php">&lt;?php
class View
{
    public static function render(string $name, array $params = [])
    {
        extract($params, EXTR_SKIP);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        require __DIR__ . '/../view/fragment/fragmentHeader.html';
        require __DIR__ . '/../view/fragment/fragmentJumbotron.html';
        require __DIR__ . '/../view/fragment/fragmentMenu.php';

        $file = __DIR__ . '/../view/' . $name . '.php';
        if (!is_file($file)) {
            http_response_code(500);
            echo "Vue introuvable : $name";
            exit();
        }

        require $file;
        require __DIR__ . '/../view/fragment/fragmentFooter.html';
    }
}
</code></pre>
        </li>
        <li>
          <strong>Charger</strong> cette classe dans <code>index.php</code> juste avant le routeur :
          <pre><code class="language-php">&lt;?php
session_start();
require __DIR__ . '/app/core/View.php';
require __DIR__ . '/app/routeur/routeur.php';
</code></pre>
        </li>
        <li>
          <strong>Remplacer</strong> dans chaque contrôleur les inclusions de fragments par un unique appel :
          <pre><code class="language-php">&lt;?php
$data = ModelX::findAll();
View::render('x/list', ['data' => $data]);
</code></pre>
        </li>
      </ol>

      <h5>Avantages</h5>
      <ul>
        <li>Plus de duplication des inclusions : un seul point d’appel.</li>
        <li>Sécurité : impossibilité d’oublier un fragment.</li>
        <li>Clarté : les contrôleurs ne contiennent plus de HTML.</li>
        <li>Maintenance : modification du layout en un seul fichier.</li>
      </ul>

      <a href="index.php?action=index" class="btn btn-secondary mt-3">← Retour</a>

    </div>
  </div>
</div>
