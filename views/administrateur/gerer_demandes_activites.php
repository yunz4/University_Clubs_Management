<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Gestion des Demandes d'Activités</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php include 'navbar_admin.php'; ?>

  <div class="container mt-5">
    <h2 class="mb-4 text-center">Demandes d'Activités</h2>

    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nom du Club</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($demandes as $index => $d): ?>
            <tr>
              <td><?= $d['id_demande'] ?></td>
              <td><?= htmlspecialchars($d['nom_club']) ?></td>
              <td>
                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                  data-bs-target="#modal<?= $index ?>">Plus</button>
              </td>
            </tr>

            <!-- Modal dynamique -->
            <div class="modal fade" id="modal<?= $index ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Détails de la Demande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <p><strong>Club :</strong> <?= htmlspecialchars($d['nom_club']) ?></p>
                    <p><strong>Date :</strong> <?= $d['date_activite'] ?></p>
                    <p><strong>Lieu :</strong> <?= htmlspecialchars($d['lieu']) ?></p>
                    <p><strong>Max étudiants :</strong> <?= $d['max_participants'] ?></p>
                    <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($d['description'])) ?></p>
                  </div>
                  <div class="modal-footer">
                    <!-- Formulaire Accepter -->
                    <form method="post" action="index.php?action=valider_demande_activite">
                      <input type="hidden" name="id_demande" value="<?= $d['id_demande'] ?>">
                      <button class="btn btn-success">Accepter</button>
                    </form>
                    <!-- Formulaire Rejeter -->
                    <form method="post" action="index.php?action=refuser_demande_activite">
                      <input type="hidden" name="id_demande" value="<?= $d['id_demande'] ?>">
                      <button class="btn btn-danger">Rejeter</button>
                    </form>
                    <!-- Bouton modifier (optionnel) -->
                    
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>