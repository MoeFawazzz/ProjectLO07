<?php

if (!defined('DEBUG')) {
    define('DEBUG', TRUE); // Turn to FALSE in production
}

// --- Define environment
define('LOCAL', TRUE); // Set to FALSE if you want to work on dev-isi

if (LOCAL) {
    define('DB_DSN', 'mysql:dbname=projet_lo07;host=localhost;charset=utf8');
    define('DB_USER', 'root');
    define('DB_PASS', '');
} else {
    define('DB_DSN', 'mysql:dbname=danguila;host=localhost;charset=utf8');
    define('DB_USER', 'danguila');
    define('DB_PASS', 'Ly4m4lZ8');
}

// chemin absolu vers le répertoire du projet SUR DEV-ISI 
$root = dirname(dirname(__DIR__)) . "/";

if (DEBUG) {
    // echo ("<ul>");
    // echo ("<li>dsn = " . DB_DSN . "</li>");
    // echo ("<li>username = " . DB_USER . "</li>");
    // echo ("<li>password = " . DB_PASS . "</li>");
    // echo ("<li>root = $root</li>");
    // echo ("</ul>");
}
?>
