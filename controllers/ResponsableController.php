<?php
require_once 'models/MembreClub.php';
require_once 'models/club.php';
require_once 'models/responsable.php';
require_once 'models/blog.php';


class ResponsableController
{
  public function creerClub()
  {
    $pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');
    $user_id = $_SESSION['user']['id_utilisateur'];

    // Trouver l'id_responsable lié à l'utilisateur connecté
    $stmt = $pdo->prepare("SELECT id_responsable FROM responsableclub WHERE id_utilisateur  = ?");
    $stmt->execute([$user_id]);
    $responsable = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$responsable) {
      die("Responsable non trouvé.");
    }

    $id_responsable = $responsable['id_responsable'];

    // Vérifier si une demande ou club existe déjà
    $stmt = $pdo->prepare("SELECT * FROM club WHERE responsable_id = ? AND (statut = 'en_attente' OR statut = 'valide')");
    $stmt->execute([$id_responsable]);
    $clubExistant = $stmt->fetch();

    $message = $_GET['message'] ?? null;

    // Variable pour contrôler l'affichage du formulaire
    $afficherFormulaire = true;

    // Si le responsable a un club/demande ou si message de succès reçu, ne pas afficher le formulaire
    if ($clubExistant || $message === 'demande_envoyee') {
      $afficherFormulaire = false;
    }
    include 'views/responsable/creer_club.php';
  }
  public function gererMembres()
  {
    $id_utilisateur = $_SESSION['user']['id_utilisateur'];
    $club_id = MembreClub::getById($id_utilisateur);
    if (!$club_id) {
      die(" Envoyer une demande pour la création!");
    }
    $membres = MembreClub::getByClub($club_id);

    $demandes = MembreClub::getDemandes($club_id);
    $info_club = Club::getById($club_id);
    include 'views/responsable/gerer_membres.php';
  }

  public function traiterDemande()
  {
    $db = Database::connect();
    $id_insc = $_POST['id_inscription'];
    $action = $_POST['action'];

    $stmt = $db->prepare("UPDATE demandeadhesion SET statut = ? WHERE demande_adh_id = ?");
    $stmt->execute([$action, $id_insc]);

    if ($action === 'accepte') {
      $stmt2 = $db->prepare("SELECT id_etudiant, id_club FROM demandeadhesion WHERE demande_adh_id = ?");
      $stmt2->execute([$id_insc]);
      $d = $stmt2->fetch(PDO::FETCH_ASSOC);

      $stmt3 = $db->prepare("
        INSERT INTO membreclub (id_etudiant, club_id, role)
        VALUES (?, ?, 'Membre')
      ");
      $stmt3->execute([$d['id_etudiant'], $d['id_club']]);
    }

    header('Location: index.php?action=gerer_membres');
    exit;
  }

  public function gererActivites()
  {
    $user_id = $_SESSION['user']['id_utilisateur'];
    $club = Responsable::getByIdUtil($user_id);
    $club_id = $club->club_id;
    $db = Database::connect();
    $stmt = $db->prepare("SELECT * FROM demandeactivite WHERE id_club = ?");
    $stmt->execute([$club_id]);

    $Demandes_act = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include 'views/responsable/gerer_activites.php';
  }

  public function ajouterDemandeActivite()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $titre = $_POST['titre'];
      $date = $_POST['date_activite'];
      $lieu = $_POST['lieu'];
      $max = $_POST['max_participants'];
      $cloture = $_POST['cloture_auto'] == 'oui' ? 1 : 0;
      $desc = $_POST['description'];

      $user_id = $_SESSION['user']['id_utilisateur']; // tu récupères le club du responsable
      $club = Responsable::getByIdUtil($user_id);
      $club_id = $club->club_id;
      $db = Database::connect();
      $stmt = $db->prepare("INSERT INTO demandeactivite (titre, date_activite, lieu, max_participants, cloture_auto, description, id_club, statut)
                              VALUES (?, ?, ?, ?, ?, ?, ?, 'en_attente')");
      $stmt->execute([$titre, $date, $lieu, $max, $cloture, $desc, $club_id]);

      header('Location: index.php?action=gerer_activites');
      exit;
    }
  }

  public function supprimerActivite()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id_demande = $_POST['id_demande'];
      $db = Database::connect();
      $stmt = $db->prepare("DELETE FROM demandeactivite WHERE id_demande = ?");
      $stmt->execute([$id_demande]);
      header('Location: index.php?action=gerer_activites');
      exit;
    }
  }

  public function modifierActivite()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id_demande'];
      $titre = $_POST['titre'];
      $date = $_POST['date_activite'];
      $lieu = $_POST['lieu'];
      $max = $_POST['max_participants'];
      $cloture = $_POST['cloture_auto'];
      $description = $_POST['description'];
      $db = Database::connect();
      $stmt = $db->prepare("
        UPDATE demandeactivite 
        SET titre = ?, date_activite = ?, lieu = ?, max_participants = ?, cloture_auto = ?, description = ?
        WHERE id_demande = ?
    ");
      $stmt->execute([$titre, $date, $lieu, $max, $cloture, $description, $id]);

      header('Location: index.php?action=gerer_activites');
      exit;
    }
  }

  public function feuillesPresence()
  {
    $user_id = $_SESSION['user']['id_utilisateur'];
    $club = Responsable::getByIdUtil($user_id);
    $club_id = $club->club_id;
    // Récupère les activités de ce club
    $db = Database::connect();
    $stmt = $db->prepare("SELECT * FROM activite WHERE club_id = ? order by date_activite desc limit 1");
    $stmt->execute([$club_id]);
    $activite = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT  u.nom, u.prenom, u.email, e.filiere
    FROM membreclub m
    JOIN etudiant e ON m.id_etudiant = e.id_etudiant
    Join utilisateur u ON e.id_utilisateur = u.id_utilisateur
    WHERE m.club_id = ? ");
    $stmt->execute([$club_id]);
    $memberes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include 'views/responsable/feuille_presences.php';
  }
  public function blogClub()
  {
    $club = Responsable::getByIdUtil($_SESSION['user']['id_utilisateur']);
    $club_id = $club->club_id;
    $articles = Blog::getByClub($club_id);
    include 'views/responsable/blog.php';
  }

  public function publierArticle()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $titre = $_POST['titre'];
      $contenu = $_POST['contenu'];
      $club = Responsable::getByIdUtil($_SESSION['user']['id_utilisateur']);
      $club_id = $club->club_id;

      Blog::ajouter($titre, $contenu, $club_id);
      header("Location: index.php?action=blog_club");
      exit;
    }
  }
  public function supprimerMembre()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_membre = $_POST['id_membre'];
        $pdo = Database::connect();

        $stmt = $pdo->prepare("DELETE FROM membreclub WHERE id_membre = ?");
        $stmt->execute([$id_membre]);

        header('Location: index.php?action=gerer_membres');
        exit;
    }
}


}
?>