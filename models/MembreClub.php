<?php
require_once 'config/database.php';
class MembreClub
{
    public static function create($etudiant_id, $club_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
      INSERT INTO demandeadhesion (etudiant_id, club_id)
      VALUES (?, ?)
    ");
        $stmt->execute([$etudiant_id, $club_id]);
    }

    public static function getById($id_utilisateur)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
        SELECT club_id
        FROM responsableclub
        WHERE id_utilisateur = ?
    ");
        $stmt->execute([$id_utilisateur]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['club_id'] : null;
    }

    public static function getByClub($club_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
      SELECT mc.id_membre, u.nom, u.prenom, u.email,e.filiere, mc.role
      FROM membreclub mc
      JOIN etudiant e ON e.id_etudiant = mc.id_etudiant
      JOIN utilisateur u ON u.id_utilisateur = e.id_utilisateur
      WHERE mc.club_id = ?
    ");
        $stmt->execute([$club_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getDemandes(int $club_id, string $statut = 'en_attente')
    {
        $db = Database::connect();
        $sql = "
            SELECT
                d.demande_adh_id,
                u.nom,
                u.email,
                e.filiere,
                d.date_demande
            FROM demandeadhesion d
            JOIN etudiant e  ON e.id_etudiant = d.id_etudiant
            JOIN utilisateur u ON u.id_utilisateur = e.id_utilisateur
            WHERE
                d.id_club = ?
              AND d.statut  = ?
            ORDER BY d.date_demande DESC
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute([$club_id, $statut]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function updateStatut(int $id_inscription, string $nouveauStatut)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            UPDATE demandeadhesion
               SET statut = ?
             WHERE demande_adh_id = ?
        ");
        $stmt->execute([$nouveauStatut, $id_inscription]);
    }

}
?>