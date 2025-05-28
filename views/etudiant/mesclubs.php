<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Mes Clubs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php include 'views/etudiant/navbar_etudiant.php'; ?>

  <div class="container mt-5">
    <h2 class="mb-4 text-center">Mes Clubs</h2>
    <div class="row row-cols-1 row-cols-md-2 g-4">

      <?php if (!empty($demandes)): ?>
        <?php foreach ($demandes as $demande): ?>
          <div class="col">
            <div class="card h-100 border-success">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($demande->nom) ?></h5>
                <p class="card-text">
                  <strong>Status :</strong>
                  <span
                    class="badge 
                    <?= $demande->statut === 'accepte' ? 'bg-success' : ($demande->statut === 'en_attente' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                    <?= htmlspecialchars($demande->statut) ?>
                  </span>
                </p>

                <?php if ($demande->statut === 'accepte'): ?>
                  <form method="post" action="index.php?action=quitter_club"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir quitter ce club ?');">
                    <input type="hidden" name="club_id" value="<?= $demande->id_club ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Quitter le Club</button>
                  </form>
                <?php elseif ($demande->statut === 'en_attente'): ?>
                  <form method="post" action="index.php?action=retirer_demande"
                    onsubmit="return confirm('Voulez-vous retirer votre demande ?');">
                    <input type="hidden" name="demande_id" value="<?= $demande->id_demande ?>">
                    <button type="submit" class="btn btn-outline-warning btn-sm">Retirer la demande</button>
                  </form>
                <?php endif; ?>

              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center text-muted">Il n’y a aucun club disponible.</p>
      <?php endif; ?>

    </div>
  </div>

</body>

</html>