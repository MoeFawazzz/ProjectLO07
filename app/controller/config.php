
<!-- ----- debut config -->
<?php

// Utile pour le débugage car c'est un interrupteur pour les echos et print_r.
if (!defined('DEBUG')) {
    define('DEBUG', FALSE);
}

// ===============
// Configuration de la base de données sur dev-isi////"dev-isi.utt.fr"
$dsn = 'mysql:dbname=danguila;host=localhost;charset=utf8';
$username = 'danguila';
$password = 'Ly4m4lZ8';
define('LOCAL', TRUE);
if (!defined('LOCAL')) {
    define('LOCAL', FALSE); // TRUE pour lancer en local
   // define('LOCAL', FALSE); // False pour lancer sur devisi 
    
} 
                   
if (LOCAL) {
    // Configuration de la base de données sur localhost
    $dsn = 'mysql:dbname=projet_lo07;host=localhost;charset=utf8';
    $username = 'root';
    $password = '';
}
 
// chemin absolu vers le répertoire du projet SUR DEV-ISI 
$root = dirname(dirname(__DIR__)) . "/";


if (DEBUG) {
 echo ("<ul>");
 echo (" <li>dsn = $dsn</li>");
 echo (" <li>username = $username</li>");
 echo (" <li>password = $password</li>");
 echo ("<li>---</li>");
 echo (" <li>root = $root</li>");

 echo ("</ul>");
}
?>

<!-- ----- fin config -->


