<?php
if (!isset($_SESSION['user'])) {
  header('Location: index.php?action=login_d');
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Dashboard Étudiant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light text-dark">
  <?php include 'views/etudiant/navbar_etudiant.php'; ?>

  <header class="bg-primary text-white text-center py-4">
    <h1 class="mb-1">Bienvenue, Étudiant</h1>
    <!-- <?= var_dump($_SESSION['user']) ?> -->

    <p class="mb-0">Gérez vos clubs et activités en un seul endroit</p>
  </header>

  <main class="container my-5">
    <div class="row g-4">

      <div class="col-md-4">
        <div class="card text-center shadow h-100">
          <div class="card-body">
            <i class="fas fa-users fa-2x text-primary mb-3"></i>
            <h5 class="card-title">Mes Clubs</h5>
            <p class="card-text">Voir les clubs que vous avez rejoints</p>
            <a href="index.php?action=etudiant_clubs" class="btn btn-primary btn-connexion mt-4">Consulter</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card text-center shadow h-100">
          <div class="card-body">
            <i class="fas fa-calendar-check fa-2x text-primary mb-3"></i>
            <h5 class="card-title">Activités Disponibles</h5>
            <p class="card-text">Inscrivez-vous aux événements à venir</p>
            <a href="index.php?action=activitesDisponibles" class="btn btn-primary btn-connexion mt-4">Connexion</a>

          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card text-center shadow h-100">
          <div class="card-body">
            <i class="fas fa-list fa-2x text-primary mb-3"></i>
            <h5 class="card-title">Mes Participations</h5>
            <p class="card-text">Consulter vos inscriptions passées</p>
            <a href="index.php?action=mes_participations" class="btn btn-primary btn-connexion mt-4">Voir plus</a>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card text-center shadow h-100">
          <div class="card-body">
            <i class="fas fa-bullhorn fa-2x text-primary mb-3"></i>
            <h5 class="card-title">Blog & Annonces</h5>
            <p class="card-text">Dernières nouvelles de vos clubs</p>
            <a href="index.php?action=blog_etudiant" class="btn btn-primary btn-connexion mt-4">Lire</a>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card text-center shadow h-100">
          <div class="card-body">
            <i class="fas fa-plus-circle fa-2x text-primary mb-3"></i>
            <h5 class="card-title">Clubs Disponibles</h5>
            <p class="card-text">Rejoindre un nouveau club universitaire</p>
            <a href="index.php?action=clubs_disponibles" class="btn btn-primary btn-connexion mt-4">S’inscrire</a>
          </div>
        </div>
      </div>

    </div>
  </main>

  <footer class="text-center py-3 bg-secondary text-white">
    &copy; 2025 - Plateforme Clubs Universitaires
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>