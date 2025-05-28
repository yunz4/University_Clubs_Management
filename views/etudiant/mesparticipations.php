<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Mes Participations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php include 'views/etudiant/navbar_etudiant.php'; ?>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Mes Participations</h2>
    <div class="table-responsive">
      <table class="table table-bordered text-center">
        <thead class="table-dark">
          <tr>
            <th>Club</th>
            <th>Activité</th>
            <th>Date</th>
            <th>Lieu</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($participations)): ?>
            <?php foreach ($participations as $p): ?>
              <tr>
                <td><?= htmlspecialchars($p['nom']) ?></td>
                <td><?= htmlspecialchars($p['titre']) ?></td>
                <td><?= htmlspecialchars($p['date_activite']) ?></td>
                <td><?= htmlspecialchars($p['lieu']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3">Aucune participation enregistrée.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>