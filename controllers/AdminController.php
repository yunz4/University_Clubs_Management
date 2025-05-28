<?php
require_once 'models/activite.php';
class AdminController
{
    public function gererDemandesClubs(): never
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'administrateur') {
            header('Location: /app_gestion_clubs/index.php?action=gest_clubs');
            exit;
        }

        $pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');

        if (isset($_POST['id'], $_POST['action'])) {
            $id = intval($_POST['id']);
            $action = $_POST['action'];

            if ($action === 'accepter') {
                // Valider le club
                $pdo->prepare("UPDATE club SET statut = 'valide' WHERE id = ?")->execute([$id]);

                // Récupérer l'id du responsable lié à ce club
                $stmt = $pdo->prepare("SELECT responsable_id FROM club WHERE id = ?");
                $stmt->execute([$id]);
                $club = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($club) {
                    $responsable_id = $club['responsable_id'];

                    // Mettre à jour responsableclub avec le club_id
                    $updateStmt = $pdo->prepare("UPDATE responsableclub SET club_id = ? WHERE id_responsable = ?");
                    $updateStmt->execute([$id, $responsable_id]);
                }

            } elseif ($action === 'refuser') {
                $pdo->prepare("DELETE FROM club WHERE id = ?")->execute([$id]);
            }
        }

        include 'views/administrateur/gest_clubs.php';
        exit;
    }

    public function rejeterClubs()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');
    
        if (isset($_POST['id'], $_POST['action']) && $_POST['action'] === 'rejeter_club') {
            $id = intval($_POST['id']);
    
            try {
                $pdo->beginTransaction();
    
                // Supprimer les dépendances liées à ce club

                $stmt = $pdo->prepare("DELETE FROM demandeactivite WHERE id_club = ?");
                $stmt->execute([$id]);

                $stmt = $pdo->prepare("DELETE FROM participationactivite WHERE club_id = ?");
                $stmt->execute([$id]);

    $stmt = $pdo->prepare("DELETE FROM activite WHERE club_id = ?");
                $stmt->execute([$id]);

                

                $stmt = $pdo->prepare("DELETE FROM demandeadhesion WHERE id_club = ?");
                $stmt->execute([$id]);
    
                $stmt = $pdo->prepare("DELETE FROM membreclub WHERE club_id = ?");
                $stmt->execute([$id]);
    
                $stmt = $pdo->prepare("UPDATE responsableclub SET club_id = NULL WHERE club_id = ?");
                $stmt->execute([$id]);
                $stmt = $pdo->prepare("DELETE from blog  WHERE club_id = ?");
                $stmt->execute([$id]);
    
                // Supprimer le club
                $stmt = $pdo->prepare("DELETE FROM club WHERE id = ?");
                $stmt->execute([$id]);
                
    
                $pdo->commit();
    
            } catch (Exception $e) {
                $pdo->rollBack();
                die("Erreur lors du rejet du club : " . $e->getMessage());
            }
        }
    
        include 'views/administrateur/gest_clubs.php';
        exit;
    }

    public function demandesActivites()
    {
        $demandes = Activite::getDemandesEnAttente();
        include 'views/administrateur/gerer_demandes_activites.php';
    }

    public function validerDemandeActivite()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_demande'];
            Activite::accepterDemande($id);
            header('Location: index.php?action=demandes_activites');
        }
    }

    public function refuserDemandeActivite()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_demande'];
            Activite::refuserDemande($id);
            header('Location: index.php?action=demandes_activites');
        }
    }

    public function voirDetail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $club_id = $_POST['club_id'];
            $pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');
            $stmt = $pdo->prepare("SELECT * FROM club WHERE id = ?");
            $stmt->execute([$club_id]);
            $club = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $pdo->prepare("
           SELECT u.nom, u.prenom, u.email 
           FROM responsableclub r 
           JOIN utilisateur u ON r.id_utilisateur = u.id_utilisateur 
           WHERE r.club_id = ?
          ");
            $stmt->execute([$club_id]);
            $responsable = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        include 'views/administrateur/statistique.php';
    }

}
?>