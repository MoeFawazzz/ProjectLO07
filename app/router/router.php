<?php
$controller = $_GET['controller'] ?? 'connexion';
$action = $_GET['action'] ?? 'formConnexion';

$controllerClass = 'Controller' . ucfirst($controller);
$controllerFile = 'app/controller/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
        $controllerClass::$action();
    } else {
        echo "<p>Erreur : action $action non trouvée dans $controllerClass.</p>";
    }
} else {
    echo "<p>Erreur : contrôleur $controllerClass introuvable.</p>";
}
