<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'administrateur') {
    header('Location: /index.php?action=login'); // Chemin absolu
    exit;
}
// ... reste du code
$pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');

$clubs = $pdo->query("SELECT * FROM club WHERE statut = 'valide'")->fetchAll(PDO::FETCH_ASSOC);
$demandes = $pdo->query("SELECT * FROM club WHERE statut = 'en_attente'")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Clubs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar_admin.php'; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Clubs</h2>
            <div>
                <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#demandesModal">
                    Voir les demandes <span class="badge bg-light text-dark"><?= count($demandes) ?></span>
                </button>
            </div>
        </div>

        <!-- Main clubs table -->
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom du Club</th>
                        <th>Description</th>
                        <th>Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clubs as $club): ?>
                        <tr>
                            <td><?= $club['id'] ?></td>
                            <td><?= htmlspecialchars($club['nom']) ?></td>
                            <td><?= htmlspecialchars($club['description']) ?></td>
                            <td>
                                <?php if (!empty($club['Logo_URL'])): ?>
                                    <img src="<?= htmlspecialchars($club['Logo_URL']) ?>" alt="logo" width="60">
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td>
                                <form method="POST" action="index.php?action=rejeterclub" style="display:inline;"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir rejeter ce club ?');">
                                    <input type="hidden" name="id" value="<?= $club['id'] ?>">
                                    <button type="submit" name="action" value="rejeter_club"
                                        class="btn btn-danger btn-sm">Rejeter</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for pending requests -->
    <div class="modal fade" id="demandesModal" tabindex="-1" aria-labelledby="demandesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demandesModalLabel">Demandes de création de clubs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <?php if (count($demandes) === 0): ?>
                        <p>Aucune demande en attente.</p>
                    <?php else: ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom Club</th>
                                    <th>Description</th>
                                    <th>Logo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($demandes as $demande): ?>
                                    <tr>
                                        <td><?= $demande['id'] ?></td>
                                        <td><?= htmlspecialchars($demande['nom']) ?></td>
                                        <td><?= nl2br(htmlspecialchars($demande['description'])) ?></td>
                                        <td>
                                            <?php if (!empty($demande['Logo_URL'])): ?>
                                                <img src="<?= htmlspecialchars($demande['Logo_URL']) ?>" alt="Logo"
                                                    style="max-height: 50px;">
                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <!--/app_gestion_clubs/views/administrateur/gestion_demande_ad.php-->
                                            <form method="POST" action="index.php?action=gest_clubs_admin">
                                                <input type="hidden" name="id" value="<?= $demande['id'] ?>">
                                                <button type="submit" name="action" value="accepter"
                                                    class="btn btn-success btn-sm">Accepter</button>
                                                <button type="submit" name="action" value="refuser"
                                                    class="btn btn-danger btn-sm">Refuser</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>