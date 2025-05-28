<?php require_once 'models/club.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Activités Disponibles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <?php include 'views/etudiant/navbar_etudiant.php'; ?>

  <header class="bg-primary text-white text-center py-4">
    <h1>Activités Disponibles</h1>
    <p class="mb-0">Liste des activités ouvertes à l'inscription</p>
  </header>

  <main class="container py-4">
    <div class="row">
      <?php if (!empty($activites)): ?>
        <?php foreach ($activites as $act): ?>
          <?php
          $id_club = $act['club_id'];
          $clubs = Club::getById($id_club);
          $nom_club = $clubs->nom;
          ?>
          <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h4 class="card-title"><?= htmlspecialchars($nom_club) ?></h4>
                <h5 class="card-title"><?= htmlspecialchars($act['titre']) ?></h5>
                <p class="card-text mb-1"><strong>Date :</strong> <?= htmlspecialchars($act['date_activite']) ?></p>
                <p class="card-text mb-1"><strong>Lieu :</strong> <?= htmlspecialchars($act['lieu']) ?></p>
                <p class="card-text mb-1"><strong>Description :</strong> <?= htmlspecialchars($act['description']) ?></p>
                <br>
                <form method="POST" action="index.php?action=inscrire_activite">
                  <input type="hidden" name="club_id" value="<?= $id_club ?>">
                  <input type="hidden" name="activite_id" value="<?= $act['activite_id'] ?>">
                  <button class="btn btn-primary">S'inscrire</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center text-muted">Aucune activité disponible pour vos clubs.</p>
      <?php endif; ?>
    </div>
  </main>

</body>

</html>