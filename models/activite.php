<?php
require_once 'config/database.php';

class Activite
{
    public static function getActivitesByEtudiant($id_utilisateur)
    {
        $db = Database::connect();

        $sql = "
        SELECT a.*
        FROM activite a
        INNER JOIN membreclub m ON a.club_id = m.club_id
        INNER JOIN etudiant e ON e.id_etudiant = m.id_etudiant
        WHERE e.id_utilisateur = ?
        ORDER BY a.date_activite DESC
    ";

        $stmt = $db->prepare($sql);
        $stmt->execute([$id_utilisateur]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getDemandesEnAttente()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT d.id_demande, d.titre, d.date_activite, d.lieu, d.max_participants, d.description, c.nom AS nom_club
                        FROM demandeactivite d
                        JOIN club c ON d.id_club = c.id
                        WHERE d.statut = 'en_attente'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function accepterDemande($id)
    {
        $db = Database::connect();
        // 1. Récupérer les infos de la demande
        $stmt = $db->prepare("SELECT * FROM demandeactivite WHERE id_demande = ?");
        $stmt->execute([$id]);
        $demande = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Insérer dans activite
        $stmt2 = $db->prepare("INSERT INTO activite (titre, description,date_activite, lieu, club_id)
                          VALUES (?, ?, ?, ?, ?)");
        $stmt2->execute([
            $demande['titre'],
            $demande['description'],
            $demande['date_activite'],
            $demande['lieu'],
            $demande['id_club']
        ]);

        // 3. Mettre à jour le statut
        $stmt3 = $db->prepare("UPDATE demandeactivite SET statut = 'validee' WHERE id_demande = ?");
        $stmt3->execute([$id]);
    }

    public static function refuserDemande($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE demandeactivite SET statut = 'refusee' WHERE id_demande = ?");
        $stmt->execute([$id]);
    }
}

