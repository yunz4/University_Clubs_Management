<?php
require_once 'config/database.php';
class Etudiant {
    public static function getByUtil($id)
{
    $db = Database::connect();
    $stmt = $db->prepare("
        SELECT id_etudiant
        FROM etudiant
        WHERE id_utilisateur = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_OBJ); 
}

}
?>