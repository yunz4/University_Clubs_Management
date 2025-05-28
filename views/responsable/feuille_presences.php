<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Feuille de Présence</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="">
  <?php include 'navbar_respo.php'; ?>
  <div class="container bg-white shadow p-4 rounded">
    <h3 class="text-center mb-4 header-title">Feuille de présence :</h3>
    <div class="mb-3">
      <p><strong>Activité :<?= htmlspecialchars($activite['titre']) ?></strong> </p>
      <p><strong>Date :<?= $activite['date_activite'] ?></strong> </p>
      <p><strong>Club :<?= $activite['lieu'] ?></strong> </p>
    </div>
    <table class="table table-bordered text-striped">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Email</th>
          <th>Filière</th>
          <th>Présent</th>
          <th>Signature</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($memberes as $index => $m): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($m['nom']) ?></td>
            <td><?= htmlspecialchars($m['prenom']) ?></td>
            <td><?= htmlspecialchars($m['email']) ?></td>
            <td><?= htmlspecialchars($m['filiere']) ?></td>
            <td><input type="checkbox" class="form-check-input"></td>
            <td></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="text-end">
      <button class="btn btn-success" onclick="window.print()">📄 Exporter en PDF</button>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>