<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'responsable') {
    header('Location: index.php?action=login');
    exit;
}

/*$pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');
$user_id = $_SESSION['user']['id_utilisateur'];

// Trouver l'id_responsable lié à l'utilisateur connecté
$stmt = $pdo->prepare("SELECT id_responsable FROM responsableclub WHERE id_utilisateur  = ?");
$stmt->execute([$user_id]);
$responsable = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$responsable) {
    die("Responsable non trouvé.");
}

$id_responsable = $responsable['id_responsable'];

// Vérifier si une demande ou club existe déjà
$stmt = $pdo->prepare("SELECT * FROM club WHERE responsable_id = ? AND (statut = 'en_attente' OR statut = 'accepte')");
$stmt->execute([$id_responsable]);
$clubExistant = $stmt->fetch();

$message = $_GET['message'] ?? null;

// Variable pour contrôler l'affichage du formulaire
$afficherFormulaire = true;

// Si le responsable a un club/demande ou si message de succès reçu, ne pas afficher le formulaire
if ($clubExistant || $message === 'demande_envoyee') {
    $afficherFormulaire = false;
}*/
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Demande de Création de Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php include 'navbar_respo.php'; ?>

    <div class="container mt-5">
        <h2>Demande de Création de Club</h2>

        <?php if ($message === 'demande_envoyee'): ?>
            <div class="alert alert-success">
                Votre demande a été envoyée avec succès !
            </div>
        <?php endif; ?>

        <?php if ($clubExistant && $message !== 'demande_envoyee'): ?>

            <div class="alert alert-warning">
                Vous avez déjà une demande en cours ou un club approuvé. Vous ne pouvez pas en faire une nouvelle.
            </div>
        <?php endif; ?>

        <?php if ($afficherFormulaire): ?>
            <form action="index.php?action=traitement_demande" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du Club</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="logo_url" class="form-label">Logo (image)</label>
                    <input type="file" class="form-control" name="logo_url" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Envoyer la demande</button>
            </form>
        <?php endif; ?>

    </div>

</body>

</html>