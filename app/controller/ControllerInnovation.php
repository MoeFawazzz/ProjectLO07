<?php
// app/controller/ControllerInnovation.php

class ControllerInnovation
{
    // … votre index(), proposeMVC(), etc.

    /** Affiche le formulaire / la page « Proposez une fonctionnalité originale » */
    public static function proposeFeature()
    {
        // Aucun traitement métier, c'est juste une page statique
        View::render('innovation/proposeFeature');
    }

    public static function proposeMVC()
    {
        View::render('innovation/proposeMVC');
    }
}
