<?php
require_once 'config/database.php';
class Participation{
    public static function create($activite_id, $club_id, $utilisateur_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
      INSERT INTO participationactivite (activite_id, club_id, utilisateur_id)
      VALUES (?, ?, ?)
    ");
        $stmt->execute([$activite_id, $club_id, $utilisateur_id]);
    }

    public static function chekByIdUti($utilisateur_id,$club_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
        SELECT COUNT(*) as total
        FROM participationactivite
        WHERE utilisateur_id= ? AND club_id = ?
    ");
        $stmt->execute([$utilisateur_id, $club_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] == 0; // retourne true si aucune demande n'existe encore
    }

    public static function getByEtudiant($id_utilisateur) {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT a.titre, a.date_activite, a.lieu, c.nom
            FROM participationactivite p
            JOIN activite a ON p.activite_id = a.activite_id
            JOIN club c ON p.club_id = c.id
            WHERE p.utilisateur_id = ?
            ORDER BY a.date_activite DESC
        ");
        $stmt->execute([$id_utilisateur]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>