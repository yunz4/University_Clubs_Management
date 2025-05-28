<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Gérer les Membres</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php include 'navbar_respo.php';?>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Gérer les Membres</h2>

    <!-- Toolbar -->
    <div class="d-flex justify-content-between mb-3 flex-wrap gap-2">
      <button class="btn btn-danger btn-sm" onclick="exportPDF()">Exporter en PDF</button>
      <div>
        <button class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#demandeModal">
          Demandes d'adhésion <span class="badge bg-light text-dark"><?= count($demandes) ?></span>
        </button>
      </div>
    </div>

    <!-- Tableau des membres -->
    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle" id="memberTable">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($membres as $m): ?>
            <tr>
              <td><?= htmlspecialchars($m['id_membre']) ?></td>
              <td><?= htmlspecialchars($m['nom']) ?></td>
              <td><?= htmlspecialchars($m['email']) ?></td>
              <td><?= htmlspecialchars($m['role']) ?></td>
              <td>
  <form method="post" action="index.php?action=supprimer_membre" onsubmit="return confirm('Êtes-vous sûr de vouloir retirer ce membre ?');">
    <input type="hidden" name="id_membre" value="<?= htmlspecialchars($m['id_membre']) ?>">
    <button type="submit" class="btn btn-danger btn-sm">Retirer</button>
  </form>
</td>

            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Demandes d'adhésion -->
  <div class="modal fade" id="demandeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Demandes d'adhésion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered text-center">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($demandes as $i => $d): ?>
                <tr>
                  <td><?= $i + 1 ?></td>
                  <td><?= htmlspecialchars($d['nom']) ?></td>
                  <td><?= htmlspecialchars($d['email']) ?></td>
                  <td>
                    <form method="post" action="index.php?action=traiter_demande"
                      class="d-flex justify-content-center gap-2">
                      <input type="hidden" name="id_inscription" value="<?= htmlspecialchars($d['demande_adh_id']) ?>">
                      <button name="action" value="accepte" class="btn btn-success btn-sm">Accepter</button>
                      <button name="action" value="refuse" class="btn btn-danger btn-sm">Rejeter</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
  <script>
    async function exportPDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();

      const nomClub = "<?= addslashes($info_club->nom ) ?>";
      doc.setFontSize(16);
      doc.text(`Liste des membres du ${nomClub}`, 50, 15);

      const rows = [];
      const tableRows = document.querySelectorAll("#memberTable tbody tr");
      tableRows.forEach(row => {
        const id = row.children[0].textContent.trim();
        const nom = row.children[1].textContent.trim();
        const email = row.children[2].textContent.trim();
        const role = row.children[3].textContent.trim();
        rows.push([id, nom, email, role]);
      });

      doc.autoTable({
        head: [['ID', 'Nom', 'Email', 'Rôle']],
        body: rows,
        startY: 25
      });

      doc.save(`membres_${nomClub.toLowerCase().replace(/\s+/g, "_")}.pdf`);
    }
  </script>


</body>

</html>