<?php
require_once 'models/club.php';
require_once 'models/etudiant.php';
require_once 'models/demande.php';
require_once 'models/activite.php';
require_once 'models/participation.php';
require_once 'models/blog.php';


class EtudiantController
{
    public function clubsDisponibles()
    {
        $clubs = Club::getAll();
        include 'views/etudiant/clubs_disponibles.php';
    }

    public function rejoindreClub()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $club_id = $_POST['club_id'];
            $etudiant = Etudiant::getByUtil($_SESSION['user']['id_utilisateur']);
            $id_etudiant = $etudiant->id_etudiant;
            $demandes = Demande::chekByIdEt($id_etudiant, $club_id);
            if ($demandes) {
                Demande::create($id_etudiant, $club_id);
                header('Location: index.php?action=etudiant_clubs');
                exit;

            } else {
                header('Location: index.php?action=etudiant_clubs');
            }

        }
    }
    public function chekDemande()
    {
        $etudiant = Etudiant::getByUtil($_SESSION['user']['id_utilisateur']);
        if (!$etudiant) {
            die("Étudiant introuvable.");
        }
        $id_etudiant = $etudiant->id_etudiant;
        $demandes = Demande::getById($id_etudiant);
        include 'views/etudiant/mesclubs.php';
    }

    public function quitterClub()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $club_id = $_POST['club_id'];
            $etudiant = Etudiant::getByUtil($_SESSION['user']['id_utilisateur']);
            $id_etudiant = $etudiant->id_etudiant;

            Demande::supprimerAdhesion($id_etudiant, $club_id);  // supprime des deux tables
            header('Location: index.php?action=mes_clubs');
            exit;
        }
    }

    public function retirerDemande()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $demande_id = $_POST['demande_id'];
            Demande::supprimerDemande($demande_id);
            header('Location: index.php?action=mes_clubs');
            exit;
        }
    }
    public function activitesDisponibles()
    {
        $id_utilisateur = $_SESSION['user']['id_utilisateur'];
        $activites = Activite::getActivitesByEtudiant($id_utilisateur);
        include 'views/etudiant/activites_disponibles.php';
    }
    public function inscrireActivite()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $club_id = $_POST['club_id'];
            $activite_id = $_POST['activite_id'];
            $utilisateur_id = $_SESSION['user']['id_utilisateur'];
            $par = Participation::chekByIdUti($utilisateur_id, $club_id);
            if ($par) {
                Participation::create($activite_id, $club_id, $utilisateur_id);
                header('Location: index.php?action=mes_participations');
                exit;

            } else {
                header('Location: index.php?action=mes_participations');
            }

        }
    }

    public function mesParticipations()
    {

        $participations = Participation::getByEtudiant($_SESSION['user']['id_utilisateur']);

        include 'views/etudiant/mesparticipations.php';
    }

    public function blogEtudiant()
    {
        $blogs = Blog::getByUtilisateur($_SESSION['user']['id_utilisateur']);
        include 'views/etudiant/mesblogs.php';
    }



}
