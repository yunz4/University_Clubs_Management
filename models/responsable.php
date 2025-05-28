<?php
require_once 'config/database.php';
class Responsable {
    public static function getByIdUtil($id)
{
    $db = Database::connect();
    $stmt = $db->prepare("
        SELECT *
        FROM responsableclub
        WHERE id_utilisateur = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_OBJ); 
}

}
?>