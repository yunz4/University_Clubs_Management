<?php
session_start();
$action = $_GET['action'] ?? 'homepage';

switch ($action) {
    case 'homepage':
        include 'views/homepage.php';
        break;

    case 'register':
        require_once 'controllers/AuthController.php';
        (new AuthController())->register();
        break;

    case 'login_d':
        include 'views/login.php';
        break;
    case 'login':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;

    case 'logout':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'etudiant_dashboard':
        include 'views/etudiant/dashboard.php';
        break;

    case 'responsable_dashboard':
        include 'views/responsable/dashboard.php';
        break;

    case 'administrateur_dashboard':
        include 'views/administrateur/dashboard.php';
        break;

    case 'mes_clubs':
        include 'views/etudiant/mesclubs.php';
        break;

    case 'clubs_disponibles':
        require_once 'controllers/EtudiantController.php';
        (new EtudiantController())->clubsDisponibles();
        break;

    case 'rejoindre_club':
        require_once 'controllers/EtudiantController.php';
        (new EtudiantController())->rejoindreClub();
        break;

    case 'etudiant_clubs':
        require_once 'controllers/EtudiantController.php';
        (new EtudiantController())->chekDemande();
        break;

    case 'gerer_club_res':
        include 'views/responsable/gerer_club.php';
        break;

    case 'gerer_membres':
        require_once 'controllers/ResponsableController.php';
        (new ResponsableController())->gererMembres();
        break;

    case 'traiter_demande':
        require_once 'controllers/ResponsableController.php';
        (new ResponsableController())->traiterDemande();
        break;

    case 'quitter_club':
        require_once 'controllers/EtudiantController.php';
        (new EtudiantController())->quitterClub();
        break;

    case 'retirer_demande':
        require_once 'controllers/EtudiantController.php';
        (new EtudiantController())->retirerDemande();
        break;

    case 'activitesDisponibles':
        require_once 'controllers/EtudiantController.php';
        (new EtudiantController())->activitesDisponibles();
        break;

    case 'gerer_activites':
        require_once 'controllers/ResponsableController.php';
        (new ResponsableController())->gererActivites();
        break;

    case 'creer_club':
        require_once 'controllers/ResponsableController.php';
        (new ResponsableController())->creerClub();
        //include 'views/responsable/creer_club.php';
        break;

    case 'inscrire_activite':
        require_once 'controllers/EtudiantController.php';
        (new EtudiantController())->inscrireActivite();
        break;

    case 'mes_participations':
        require_once 'controllers/EtudiantController.php';
        (new EtudiantController())->mesParticipations();
        break;

    case 'ajouter_activite':
        require_once 'controllers/ResponsableController.php';
        (new ResponsableController())->ajouterDemandeActivite();
        break;


    case 'supprimer_activite':
        require_once 'controllers/ResponsableController.php';
        (new ResponsableController())->supprimerActivite();
        break;

    case 'modifier_activite':
        require_once 'controllers/ResponsableController.php';
        (new ResponsableController())->modifierActivite();
        break;


    case 'feuilles_presence':
        require_once 'controllers/ResponsableController.php';
        (new ResponsableController())->feuillesPresence();
        break;

    case 'blog_club':
        require_once 'controllers/ResponsableController.php';
        (new ResponsableController())->blogClub();
        break;

    case 'publier_article':
        require_once 'controllers/ResponsableController.php';
        (new ResponsableController())->publierArticle();
        break;

    case 'blog_etudiant':
        require_once 'controllers/EtudiantController.php';
        (new EtudiantController())->blogEtudiant();
        break;

    case 'traitement_demande':
        include 'views/responsable/traitement_demande.php';
        break;

    case 'gest_clubs_admin':
        require_once 'controllers/AdminController.php';
        (new AdminController())->gererDemandesClubs();
        //include 'views/administrateur/gest_clubs.php';
        break;

    case 'rejeterclub':
        require_once 'controllers/AdminController.php';
        (new AdminController())->rejeterClubs();
        //include 'views/administrateur/gest_clubs.php';
        break;

    case 'gerer_ressource_ad':
        include 'views/administrateur/gerer_ressource_ad.php';
        break;

    case 'demandes_activites':
        require_once 'controllers/AdminController.php';
        (new AdminController())->demandesActivites();
        break;

    case 'valider_demande_activite':
        require_once 'controllers/AdminController.php';
        (new AdminController())->validerDemandeActivite();
        break;

    case 'refuser_demande_activite':
        require_once 'controllers/AdminController.php';
        (new AdminController())->refuserDemandeActivite();
        break;

    case 'ajouter_ressource':
        require_once 'controllers/RessourceController.php';
        $controller = new RessourceController();
        $controller->ajouterRessource();
        break;
    case 'ressources':
        require_once 'controllers/RessourceController.php';
        $controller = new RessourceController();
        $controller->afficherRessources();
        break;

    case 'supprimer_ressource':
        require_once 'controllers/RessourceController.php';
        $controller = new RessourceController();
        $controller->supprimerRessource();
        break;

    case 'statistique':
        include 'views/administrateur/statistique.php';
        break;

    case 'Dstatistique':
        require_once 'controllers/AdminController.php';
        (new AdminController())->voirDetail();
        break;

    
    case 'club_detail':
        include 'views/administrateur/club_detail.php';
        break;

    case 'club_detail2':
        include 'views/administrateur/club_detail.php';
        break;


        case 'supprimer_membre':
            require_once 'controllers/ResponsableController.php';
            $controller = new ResponsableController();
            $controller->supprimerMembre();
            break;
        

    default:
        echo "Page introuvable.";
}
if ($action === 'code_generer') {
    require_once 'controllers/CodeController.php';
    $controller = new CodeController();
    $controller->genererCode();
}
?>