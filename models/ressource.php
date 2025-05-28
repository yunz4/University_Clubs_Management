<?php
require_once(__DIR__ . '/../config/database.php');

class Ressource
{
    public static function ajouter($nom, $type, $quantite, $club_id, $disponibilite)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO ressource (nom_ressource, type_ressource, quantite, club_id, disponibilite) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $type, $quantite, $club_id, $disponibilite]);
    }
    public static function getAll()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM ressource");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function supprimer($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM ressource WHERE id_ressource = ?");
        $stmt->execute([$id]);
    }

}