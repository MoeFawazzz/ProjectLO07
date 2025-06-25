<?php
// app/controller/ControllerInnovation.php
require_once(__DIR__ . '/../model/Model.php');

class ControllerInnovation
{
    // … votre index(), proposeMVC(), etc.

    /** Affiche le formulaire / la page « Proposez une fonctionnalité originale » */
    public static function proposeFeature()
    {
        // Aucun traitement métier, c'est juste une page statique
        require __DIR__ . '/../view/innovation/proposeFeature.php';
    }

    public static function proposeMVC()
    {
        require __DIR__ . '/../view/innovation/proposeMVC.php';
    }
}
