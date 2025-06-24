<?php
// app/model/Model.php
require_once __DIR__ . '/../controller/config.php';

class Model
{
    /** @var PDO */
    protected static $pdo = null;

    protected static function initPDO()
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la BDD : ' . $e->getMessage());
            }
        }
    }

    protected static function selectAll(string $sql, array $params = []): array
    {
        self::initPDO();
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected static function selectOne(string $sql, array $params = [])
    {
        self::initPDO();
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected static function executeQuery(string $sql, array $params = []): bool
    {
        self::initPDO();
        $stmt = self::$pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Renvoie la prochaine valeur d'id pour une table sans AUTO_INCREMENT
     * @param string $table Nom de table
     * @return int
     */
    protected static function getNextId(string $table): int
    {
        self::initPDO();
        // Attention aux injections : table contrôlée dans le code
        $sql = "SELECT MAX(id) AS maxid FROM {$table}";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return ((int)$row['maxid']) + 1;
    }
}
