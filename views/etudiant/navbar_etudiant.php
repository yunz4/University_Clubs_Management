<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
    header('Location: index.php?action=login_d');
    exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');

// Récupérer nom et prénom de l’étudiant connecté
$stmt = $pdo->prepare("SELECT nom, prenom FROM utilisateur WHERE id_utilisateur = ?");
$stmt->execute([$_SESSION['user']['id_utilisateur']]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
$nom = $userData['nom'] ?? 'Nom';
$prenom = $userData['prenom'] ?? 'Prénom';
?>

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        #navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
        }

        body {
            padding-top: 56px;
        }
    </style>
</head>

<body>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php?action=etudiant_dashboard">
                <i class="fas fa-user-graduate me-2"></i>Tableau de bord
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#etudiantNavbar"
                aria-controls="etudiantNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="etudiantNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php?action=etudiant_clubs">
                            <i class="fas fa-users me-1"></i>Mes Clubs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php?action=activitesDisponibles">
                            <i class="fas fa-calendar-check me-1"></i>Activités Disponibles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php?action=mes_participations">
                            <i class="fas fa-list me-1"></i>Mes Participations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php?action=blog_etudiant">
                            <i class="fas fa-bullhorn me-1"></i>Blog & Annonces
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php?action=clubs_disponibles">
                            <i class="fas fa-plus-circle me-1"></i>Clubs Disponibles
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text text-white me-3">
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