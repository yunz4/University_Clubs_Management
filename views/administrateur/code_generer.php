<!DOCTYPE html>
<html>
<head>
    <title>Code Responsable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light text-center p-5">
    <h2 class="text-success">Code généré avec succès :</h2>
    <div class="alert alert-primary fs-4 mt-4 w-50 mx-auto"><?= htmlspecialchars($code) ?></div>
    <a href="index.php?action=administrateur_dashboard" class="btn btn-danger mt-3">Retour au tableau de bord</a>
</body>
</html>