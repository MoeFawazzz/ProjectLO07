<?php
// app/model/ModelNotification.php

require_once __DIR__ . '/Model.php';

require_once __DIR__ . '/../model/ModelNotification.php';

class ModelNotification extends Model
{
    public static function addNotification(int $etudiantId, string $message): bool
    {
        $sql = "INSERT INTO notification (etudiant_id, message) VALUES (:id, :msg)";
        return self::executeQuery($sql, ['id' => $etudiantId, 'msg' => $message]);
    }

    // Récupérer les notifications d’un étudiant
    public static function getNotificationsByEtudiant(int $etudiantId): array
    {
        $sql = "SELECT * FROM notification WHERE etudiant_id = :id ORDER BY created_at DESC";
        return self::selectAll($sql, ['id' => $etudiantId]);
    }

    // Compter les notifications non lues
    public static function countUnreadByEtudiant(int $etudiantId): int
    {
        $sql = "SELECT COUNT(*) as unread_count FROM notification WHERE etudiant_id = :id AND is_read = 0";
        $result = self::selectOne($sql, ['id' => $etudiantId]);
        return $result ? (int)$result['unread_count'] : 0;
    }



    // Supprimer une notification (optionnel)
public static function deleteNotification(int $id): bool
{
    $sql = "DELETE FROM notification WHERE id = :id";
    return self::executeQuery($sql, ['id' => $id]);
}

}
