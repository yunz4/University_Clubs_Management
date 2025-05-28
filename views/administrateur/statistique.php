<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'administrateur') {
    header('Location: index.php?action=login');
    exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');

// Récupérer tous les clubs
$stmt = $pdo->query("SELECT id, nom, logo_url FROM club ORDER BY nom");
$clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traiter la sélection d’un club
$club = null;
$responsable = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['club_id'])) {
    $club_id = (int) $_POST['club_id'];

    // Détails du club
    $stmt = $pdo->prepare("SELECT * FROM club WHERE id = ?");
    $stmt->execute([$club_id]);
    $club = $stmt->fetch(PDO::FETCH_ASSOC);

    // Responsable du club
    $stmt = $pdo->prepare("
        SELECT u.nom, u.prenom, u.email
        FROM responsableclub r
        JOIN utilisateur u ON r.id_utilisateur = u.id_utilisateur
        WHERE r.club_id = ?
    ");
    $stmt->execute([$club_id]);
    $responsable = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Statistiques des Clubs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .club-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-right: 15px;
            border-radius: 50%;
            border: 2px solid #ddd;
        }

        .club-card {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 15px;
            background: white;
        }
    </style>
</head>

<body class="bg-light">

    <?php include 'navbar_admin.php'; ?>

    <div class="container py-5">
        <h2 class="text-center mb-4">Statistiques des Clubs</h2>

        <?php if (empty($clubs)): ?>
            <p class="text-center">Aucun club trouvé.</p>
        <?php else: ?>
            <?php foreach ($clubs as $c): ?>
                <div class="club-card shadow-sm">
                    <img src="<?= htmlspecialchars($c['logo_url'] ?: 'default_logo.png') ?>"
                        alt="Logo <?= htmlspecialchars($c['nom']) ?>" class="club-logo">
                    <div class="flex-grow-1">
                        <h5><?= htmlspecialchars($c['nom']) ?></h5>
                        <p>👥 Membres : (à calculer)</p>
                        <form method="post" class="mb-0">
                            <input type="hidden" name="club_id" value="<?= $c['id'] ?>">
                            <button type="submit" class="btn btn-primary btn-sm" >Voir détails</button>
                        </form>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Modal : Détails du club -->
        <div class="modal fade" id="clubDetailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails du Club</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php if ($club): ?>
                            <script>
                                window.addEventListener('DOMContentLoaded', function () {
                                    var modal = new bootstrap.Modal(document.getElementById('clubDetailModal'));
                                    modal.show();
                                });
                            </script>
                            <div class="text-center mb-4">
                                <img src="<?= htmlspecialchars($club['Logo_URL'] ?: 'default_logo.png') ?>"
                                    alt="Logo <?= htmlspecialchars($club['nom']) ?>"
                                    style="width:150px; height:150px; object-fit: contain; border-radius:10px;">
                            </div>
                            <h4><?= htmlspecialchars($club['nom']) ?></h4>
                            <p><strong>Description :</strong><br><?= nl2br(htmlspecialchars($club['description'])) ?></p>
                            <p><strong>Statut :</strong> <?= htmlspecialchars($club['statut']) ?></p>
                            <hr>
                            <?php if ($responsable): ?>
                                <h5>Responsable du Club</h5>
                                <p><strong>Nom :</strong> <?= htmlspecialchars($responsable['nom']) ?>
                                    <?= htmlspecialchars($responsable['prenom']) ?>
                                </p>
                                <p><strong>Email :</strong> <?= htmlspecialchars($responsable['email']) ?></p>
                            <?php else: ?>
                                <p class="text-muted">Aucun responsable associé.</p>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="text-center text-muted">Sélectionnez un club pour voir ses détails.</p>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>