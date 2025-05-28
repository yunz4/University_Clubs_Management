<?php
require_once 'config/database.php';
class Demande
{
    public static function create($etudiant_id, $club_id)
    {
        $sql = "
      INSERT INTO demandeadhesion (id_etudiant, id_club)
      VALUES (?, ?)
    ";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute([$etudiant_id, $club_id]);
    }
    public static function chekByIdEt($id_etudiant, $id_club)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
        SELECT COUNT(*) as total
        FROM demandeadhesion
        WHERE id_etudiant = ? AND id_club = ?
    ");
        $stmt->execute([$id_etudiant, $id_club]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] == 0; // retourne true si aucune demande n'existe encore
    }

    public static function getById($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
        SELECT d.demande_adh_id AS id_demande, d.statut, c.nom, c.id AS id_club
        FROM demandeadhesion d
        JOIN club c ON d.id_club = c.id
        WHERE d.id_etudiant = ?
    ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function supprimerAdhesion($id_etudiant, $id_club)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM demandeadhesion WHERE id_etudiant = ? AND id_club = ? AND statut = 'accepte'");
        $stmt->execute([$id_etudiant, $id_club]);
        $stmt1 = $db->prepare("DELETE FROM membreclub WHERE id_etudiant = ? AND club_id = ?");
        $stmt1->execute([$id_etudiant, $id_club]);
    }

    public static function supprimerDemande($id_demande)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM demandeadhesion WHERE demande_adh_id = ?");
        $stmt->execute([$id_demande]);
    }

}
?>