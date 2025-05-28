<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Gérer les Activités</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php include 'navbar_respo.php'; ?>

  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Gérer les Activités</h2>
      <div>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createActivityModal">
          Créer une Activité
        </button>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date</th>
            <th>Lieu</th>
            <th>Max</th>
            <th>Clôture auto</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Demandes_act as $a): ?>
            <?php
            // Déterminer la couleur du badge selon le statut
            $statut = strtolower($a['statut']);
            $badgeClass = match ($statut) {
              'validee' => 'bg-success',
              'refusee' => 'bg-danger',
              'en_attente' => 'bg-warning text-dark',
              default => 'bg-secondary'
            };
            ?>
            <tr>
              <td><?= $a['id_demande'] ?></td>
              <td><?= htmlspecialchars($a['titre']) ?></td>
              <td><?= $a['date_activite'] ?></td>
              <td><?= htmlspecialchars($a['lieu']) ?></td>
              <td><?= $a['max_participants'] ?></td>
              <td><?= $a['cloture_auto'] ? 'Oui' : 'Non' ?></td>
              <td><span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($a['statut']) ?></span></td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-warning btn-sm " data-bs-toggle="modal"
                  data-bs-target="#modifierModal<?= $a['id_demande'] ?>">Modifier</button></form>
                <form method="post" action="index.php?action=supprimer_activite"
                  onsubmit="return confirm('Confirmer la suppression ?')">
                  <input type="hidden" name="id_demande" value="<?= $a['id_demande'] ?>">
                  <button class="btn btn-danger btn-sm">Supprimer</button>
                </form>

              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal : Créer une Activité -->
  <div class="modal fade" id="createActivityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="index.php?action=ajouter_activite">
          <div class="modal-header">
            <h5 class="modal-title">Créer une Nouvelle Activité</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="text" name="titre" class="form-control mb-2" placeholder="Titre de l'activité" required>
            <input type="date" name="date_activite" class="form-control mb-2" required>
            <input type="text" name="lieu" class="form-control mb-2" placeholder="Lieu" required>
            <input type="number" name="max_participants" class="form-control mb-2" placeholder="Participants max"
              required>
            <select name="cloture_auto" class="form-select mb-2" required>
              <option value="oui">Clôture auto : Oui</option>
              <option value="non">Clôture auto : Non</option>
            </select>
            <textarea name="description" class="form-control mb-2" rows="3" placeholder="Description..."></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal de modification -->
  <div class="modal fade" id="modifierModal<?= $a['id_demande'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="index.php?action=modifier_activite">
          <div class="modal-header">
            <h5 class="modal-title">Modifier l'Activité</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_demande" value="<?= $a['id_demande'] ?>">
            <input type="text" name="titre" class="form-control mb-2" value="<?= htmlspecialchars($a['titre']) ?>"
              required>
            <input type="date" name="date_activite" class="form-control mb-2" value="<?= $a['date_activite'] ?>"
              required>
            <input type="text" name="lieu" class="form-control mb-2" value="<?= htmlspecialchars($a['lieu']) ?>"
              required>
            <input type="number" name="max_participants" class="form-control mb-2" value="<?= $a['max_participants'] ?>"
              required>
            <select name="cloture_auto" class="form-select mb-2" required>
              <option value="oui" <?= $a['cloture_auto'] == 'oui' ? 'selected' : '' ?>>Clôture auto : Oui</option>
              <option value="non" <?= $a['cloture_auto'] == 'non' ? 'selected' : '' ?>>Clôture auto : Non</option>
            </select>
            <textarea name="description" class="form-control mb-2"
              rows="3"><?= htmlspecialchars($a['description']) ?></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>