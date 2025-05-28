<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Blog Étudiant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php include 'views/etudiant/navbar_etudiant.php'; ?>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Actualités de mes clubs</h2>

    <?php if (!empty($blogs)): ?>
      <?php foreach ($blogs as $b): ?>
        <div class="card mb-3">
          <div class="card-header ">
            <strong><?= htmlspecialchars($b['titre']) ?></strong> <span class="text-muted">— <?= $b['nom_club'] ?></span>
          </div>
          <div class="card-body">
            <p><?= nl2br(htmlspecialchars($b['contenu'])) ?></p>
            <small class="text-muted">Publié le <?= date('d/m/Y', strtotime($b['date_creation'])) ?></small>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-muted text-center">Aucun article disponible pour vos clubs.</p>
    <?php endif; ?>
  </div>
</body>

</html>