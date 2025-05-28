<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'responsable') {
    header('Location: index.php?action=login');
    exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');

// Récupérer nom et prénom du responsable connecté
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
        /* Navbar fixée */
        #navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
        }

        body {
            padding-top: 56px;
            /* espace pour que le contenu ne soit pas caché */
        }
    </style>
</head>

<body>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?action=responsable_dashboard">
                <i class="fas fa-user-cog me-2"></i>Responsable Club
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#respoNavbar"
                aria-controls="respoNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="respoNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=creer_club">
                            <i class="fas fa-cogs me-1"></i>Créer un club
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=gerer_membres">
                            <i class="fas fa-users me-1"></i>Membres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=gerer_activites">
                            <i class="fas fa-calendar-alt me-1"></i>Activités
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=feuilles_presence">
                            <i class="fas fa-file-alt me-1"></i>Feuilles de présence
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=blog_club">
                            <i class="fas fa-blog me-1"></i>Blog
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