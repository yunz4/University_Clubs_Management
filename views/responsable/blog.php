<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Blog du Club</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php include 'navbar_respo.php'; ?>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Blog du Club</h2>

    <!-- Formulaire d'ajout -->
    <div class="card mb-4">
      <div class="card-header">Nouvel Article</div>
      <div class="card-body">
        <form method="post" action="index.php?action=publier_article">
          <div class="mb-3">
            <label for="titre" class="form-label">Titre du message</label>
            <input type="text" name="titre" class="form-control" id="titre" placeholder="Ex : Nouvel évènement"
              required>
          </div>
          <div class="mb-3">
            <label for="contenu" class="form-label">Contenu du message</label>
            <textarea name="contenu" class="form-control" id="contenu" rows="4" placeholder="Contenu..."
              required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Publier</button>
        </form>
      </div>
    </div>

    <!-- Articles existants -->
    <?php foreach ($articles as $article): ?>
      <div class="card mb-3">
        <div class="card-header">
          <strong><?= htmlspecialchars($article['titre']) ?> –
            <?= date('d/m/Y', strtotime($article['date_creation'])) ?></strong>
        </div>
        <div class="card-body">
          <p><?= nl2br(htmlspecialchars($article['contenu'])) ?></p>
        </div>
      </div>
    <?php endforeach; ?>

  </div>

</body>

</html>