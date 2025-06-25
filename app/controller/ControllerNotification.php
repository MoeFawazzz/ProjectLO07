<?php
require_once __DIR__ . '/../model/ModelNotification.php';
require_once __DIR__ . '/../core/View.php';

class ControllerNotification
{
    public static function listNotifications()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $etudiantId = $_SESSION['login_id'] ?? 0;
        if (!$etudiantId || empty($_SESSION['role_etudiant'])) {
            header('Location: index.php?action=formConnexion');
            exit();
        }

        $notifs = ModelNotification::getNotificationsByEtudiant($etudiantId);
        View::render('etudiant/notifications', ['notifications' => $notifs]);
    }
    public static function delete()
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_GET['id']) || empty($_SESSION['role_etudiant'])) {
        header('Location: index.php?action=formConnexion');
        exit();
    }

    $notifId = (int)$_GET['id'];
    $ok = ModelNotification::deleteNotification($notifId);

    $_SESSION['success_message'] = $ok ? "Notification supprimée." : "Erreur lors de la suppression.";
    header('Location: index.php?controller=notification&action=listNotifications');
    exit();
}

}
