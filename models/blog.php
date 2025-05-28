<?php
require_once 'config/database.php';

class Blog {
    public static function ajouter($titre, $contenu, $club_id) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO blog (titre, contenu, club_id) VALUES (?, ?, ?)");
        $stmt->execute([$titre, $contenu, $club_id]);
    }

    public static function getByClub($club_id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM blog WHERE club_id = ? ORDER BY date_creation DESC");
        $stmt->execute([$club_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByUtilisateur($id_utilisateur) {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT b.titre, b.contenu, b.date_creation, c.nom AS nom_club
            FROM blog b
            JOIN club c ON b.club_id = c.id
            JOIN membreclub m ON m.club_id = b.club_id
            JOIN etudiant e ON m.id_etudiant = e.id_etudiant
            WHERE e.id_utilisateur = ?
            ORDER BY b.date_creation DESC
        ");
        $stmt->execute([$id_utilisateur]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>