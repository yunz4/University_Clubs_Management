<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Gérer le Club - Responsable</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f6fa;
    }

    header {
      background-color: #192a56;
      color: white;
      padding: 30px 20px;
      text-align: center;
    }

    .logo-preview img {
      max-width: 150px;
      margin-top: 10px;
      border-radius: 8px;
      border: 1px solid #ddd;
    }
  </style>
</head>

<body>
  <?php include 'navbar_respo.php'; ?>

  <header>
    <h1>Gérer le Club</h1>
    <p>Modifier les informations du club</p>
  </header>

  <main class="container my-5">
    <form>
      <div class="mb-3">
        <label for="nom" class="form-label">Nom du club :</label>
        <input type="text" class="form-control" id="nom" value="" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description :</label>
        <textarea id="description" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label for="logo" class="form-label">Logo du club :</label>
        <input type="file" id="logo" class="form-control" accept="image/*">
        <div class="logo-preview mt-3">
          <p>Aperçu :</p>
          <img id="preview" src="https://via.placeholder.com/150" alt="Logo du club">
        </div>
      </div>

      <div class="mb-4">
        <h3>Responsables du Club</h3>
        <div class="mb-3">
          <label class="form-label">Président :</label>
          <input type="text" class="form-control" placeholder="Nom du président">
        </div>
        <div class="mb-3">
          <label class="form-label">Vice-Président :</label>
          <input type="text" class="form-control" placeholder="Nom du vice-président">
        </div>
        <div class="mb-3">
          <label class="form-label">Secrétaire :</label>
          <input type="text" class="form-control" placeholder="Nom du secrétaire">
        </div>
      </div>

      <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
    </form>
  </main>

  <script>
    document.getElementById("logo").addEventListener("change", function () {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("preview").src = e.target.result;
      };
      reader.readAsDataURL(this.files[0]);
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>