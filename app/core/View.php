<?php
// app/core/View.php

class View
{
    /**
     * Renders a view with our standard layout (header, jumbotron, menu, footer).
     *
     * @param string $name   Chemin relatif sous app/view
     * @param array  $params Variables à extraire dans la vue 
     */
    public static function render(string $name, array $params = [])
    {
        // 1) Extract variables for use in the view
        extract($params, EXTR_SKIP);

        // 2) Ensure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 3) Include layout fragments
        require __DIR__ . '/../view/fragment/fragmentHeader.html';
        require __DIR__ . '/../view/fragment/fragmentJumbotron.html';
        require __DIR__ . '/../view/fragment/fragmentMenu.php';

        // 4) Include the actual view file
        $file = __DIR__ . '/../view/' . $name . '.php';
        if (!is_file($file)) {
            http_response_code(500);
            echo "Vue introuvable : $name";
            exit();
        }
        require $file;

        // 5) Include footer
        require __DIR__ . '/../view/fragment/fragmentFooter.html';
    }
}
