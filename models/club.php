<?php
require_once 'config/database.php';

class Club
{
    public static function getAll()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM club");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getById($id_club)
    {
        $db = Database::connect();
        $sql = "SELECT * 
            FROM club 
            WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_club]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}
