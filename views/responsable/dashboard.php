<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'responsable') {
    header('Location: index.php?action=login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Responsable de Club</title>
    <!-- Ajout du CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php include 'navbar_respo.php'; ?>
    <header class="bg-success text-white text-center py-5">
        <h1>Salut, Responsable de Club</h1>
        <p>Gérez votre club efficacement</p>
    </header>


    <main class="container mt-5">
        <section class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <div class="card text-center shadow h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-cogs fa-3x text-success mb-3"></i>
                        <h2 class="card-title">Créer un Club</h2>
                        <p class="card-text">Envoyer une demande pour la création d’un nouveau club</p>
                        <a href="index.php?action=creer_club" class="btn btn-success">Faire une demande</a>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center shadow h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h2 class="card-title">Gérer les Membres</h2>
                        <p class="card-text">Ajouter, supprimer ou modifier des membres et définir leurs rôles</p>
                        <a href="index.php?action=gerer_membres" class="btn btn-success">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center shadow h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-alt fa-3x text-success mb-3"></i>
                        <h2 class="card-title">Gérer les Activités</h2>
                        <p class="card-text">Créer une activité, planifier la date et le lieu, fixer le nombre de
                            participants et clôturer les inscriptions</p>
                        <a href="index.php?action=gerer_activites" class="btn btn-success">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center shadow h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-file-alt fa-3x text-success mb-3"></i>
                        <h2 class="card-title">Feuille de Présence </h2>
                        <p class="card-text">Télécharger la feuille de présence </p>
                        <a href="index.php?action=feuilles_presence" class="btn btn-success">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center shadow h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-file-alt fa-3x text-success mb-3"></i>
                        <h2 class="card-title">Blog</h2>
                        <p class="card-text"> publier des annonces sur le blog</p>
                        <a href="index.php?action=blog_club" class="btn btn-success">Accéder</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-light text-center py-3 mt-5">
        <p>&copy; 2025 - Plateforme Clubs Universitaires</p>
    </footer>

    <!-- Ajout des scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>