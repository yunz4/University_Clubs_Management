<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'administrateur') {
    header('Location: index.php?action=login');
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');

// Récupérer nom et prénom de l'admin connecté
$stmt = $pdo->prepare("SELECT nom, prenom FROM utilisateur WHERE id_utilisateur = ?");
$stmt->execute([$_SESSION['user']['id_utilisateur']]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
$nom = $userData['nom'] ?? 'Nom';
$prenom = $userData['prenom'] ?? 'Prénom';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard Administrateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        /* Navbar fixée en haut */
        #navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
        }

        body {
            padding-top: 56px;
            /* Hauteur navbar Bootstrap */
        }
    </style>
</head>

<body>

    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?action=administrateur_dashboard">
                <i class="fas fa-user-shield me-2"></i>Administrateur
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=gest_clubs_admin">
                            <i class="fas fa-university me-1"></i>Clubs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=demandes_activites">
                            <i class="fas fa-envelope-open-text me-1"></i>Demandes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=ressources">
                            <i class="fas fa-tools me-1"></i>Ressources
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=statistique">
                            <i class="fas fa-chart-line me-1"></i>Statistiques
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text me-3">
                            <i class="fas fa-user-circle me-1"></i>
                            <?= htmlspecialchars($prenom . ' ' . $nom); ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="index.php?action=logout">
                            <i class="fas fa-sign-out-alt me-1"></i>Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>