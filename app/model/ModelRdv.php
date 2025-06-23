<?php
require_once __DIR__ . '/Model.php';

class ModelRdv extends Model
{
    public static function getAll(): array
    {
        // Utilise la vue infordv
        $sql = "SELECT * FROM infordv";
        return self::selectAll($sql);
    }

    public static function getById(int $id)
    {
        $sql = "SELECT * FROM infordv WHERE id = :id";
        return self::selectOne($sql, ['id' => $id]);
    }
}