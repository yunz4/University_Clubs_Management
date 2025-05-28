<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'administrateur') {
    header('Location: index.php?action=login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-light">
    <?php include 'navbar_admin.php';?>

    <header class="bg-danger text-white text-center py-4">
        <h1>Bonjour Administrateur</h1>
        <p>Gérez efficacement l'administration des clubs universitaires</p>
    </header>

    <main class="container my-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-university fa-2x text-danger mb-3"></i>
                        <h5 class="card-title">Gestion des Clubs</h5>
                        <p class="card-text">Examiner, supprimer ou modifier les informations des clubs</p>
                        <a href="index.php?action=gest_clubs_admin" class="btn btn-danger w-100">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-envelope-open-text fa-2x text-danger mb-3"></i>
                        <h5 class="card-title">Gestion des Demandes</h5>
                        <p class="card-text">Examiner et traiter les demandes d’activités</p><br>
                        <a href="index.php?action=demandes_activites" class="btn btn-danger w-100">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-tools fa-2x text-danger mb-3"></i>
                        <h5 class="card-title">Gestion des Ressources</h5>
                        <p class="card-text">Réserver les salles et équipements, suivre leur disponibilité</p>
                        <a href="index.php?action=ressources" class="btn btn-danger w-100">Accéder</a>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-chart-line fa-2x text-danger mb-3"></i>
                        <h5 class="card-title">Statistiques</h5>
                        <p class="card-text">Consulter le nombre de membres, taux de participation et l’évolution de
                            l’activité</p>
                        <a href="index.php?action=statistique" class="btn btn-danger w-100">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-key fa-2x text-danger mb-3"></i>
                        <h5 class="card-title">Code d'inscription</h5>
                        <p class="card-text">Générer un code pour qu’un responsable puisse s’inscrire</p>
                        <form method="POST" action="index.php?action=code_generer">
                            <button type="submit" class="btn btn-danger w-100">Générer</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </main>

    <footer class="text-center bg-secondary text-white py-3">
        &copy; 2025 - Plateforme Clubs Universitaires
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>