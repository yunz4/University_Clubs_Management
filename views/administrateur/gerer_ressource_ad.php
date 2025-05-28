<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Gestion des Ressources</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <?php include 'navbar_admin.php'; ?>

  <div class="container py-5">
    <h2 class="text-center mb-4">Gestion des Ressources</h2>
    <div class="d-flex justify-content-end mb-3">
      <!-- Bouton pour ouvrir la modal -->
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addResourceModal">
        Ajouter une ressource
      </button>
    </div>

    <table class="table table-bordered table-hover bg-white shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nom de la ressource</th>
          <th>Type</th>
          <th>Disponibilité</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($ressources) && is_array($ressources)): ?>
          <?php foreach ($ressources as $ressource): ?>
            <tr>
              <td><?= htmlspecialchars($ressource['id_ressource']) ?></td>
              <td><?= htmlspecialchars($ressource['nom_ressource']) ?></td>
              <td><?= htmlspecialchars($ressource['type_ressource']) ?></td>
              <td>
                <span class="badge <?= $ressource['disponibilite'] === 'disponible' ? 'bg-success' : 'bg-danger' ?> statut">
                  <?= ucfirst($ressource['disponibilite']) ?>
                </span>
              </td>
              <td>
                <form method="POST" action="index.php?action=supprimer_ressource"
                  onsubmit="return confirm('Supprimer cette ressource ?')">
                  <input type="hidden" name="id_ressource" value="<?= $ressource['id_ressource'] ?>">
                  <button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center"></td>
          </tr>
        <?php endif; ?>
      </tbody>

    </table>
  </div>
  <!-- MODAL AJOUTER UNE RESSOURCE -->
  <div class="modal fade" id="addResourceModal" tabindex="-1" aria-labelledby="addResourceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="index.php?action=ajouter_ressource">
          <div class="modal-body">
            <div class="mb-3">
              <label for="resourceName" class="form-label">Nom de la ressource</label>
              <input type="text" class="form-control" id="resourceName" name="nom_ressource" required>
            </div>
            <div class="mb-3">
              <label for="resourceType" class="form-label">Type</label>
              <select class="form-select" id="resourceType" name="type_ressource" required>
                <option value="">Choisir...</option>
                <option value="materiel">Matériel</option>
                <option value="humain">Humain</option>
                <option value="financier">Financier</option>
                <option value="autre">Autre</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="quantite" class="form-label">Quantité</label>
              <input type="number" class="form-control" id="quantite" name="quantite" value="1" min="1">
            </div>
            <div class="mb-3">
              <label for="resourceStatus" class="form-label">Disponibilité</label>
              <select class="form-select" id="resourceStatus" name="disponibilite" required>
                <option value="disponible">Disponible</option>
                <option value="indisponible">Indisponible</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          </div>
        </form>

      </div>
    </div>
  </div>
  <script>


    // Supprimer une ressource
    document.querySelectorAll('.delete-btn').forEach((btn) => {
      btn.addEventListener('click', function () {
        if (confirm("Voulez-vous vraiment supprimer cette ressource ?")) {
          const row = this.closest('tr');
          row.remove();
        }
      });
    });
  </script>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>