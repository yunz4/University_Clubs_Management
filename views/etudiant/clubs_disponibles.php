<?php

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Clubs Disponibles - Étudiant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f6fa;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .club-card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .club-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-right: 15px;
            border-radius: 50%;
            border: 2px solid #ddd;
            flex-shrink: 0;
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

<body>
    <?php include 'views/etudiant/navbar_etudiant.php'; ?>
    <header>
        <h1>Clubs Disponibles</h1>
        <p class="lead">Découvrez les clubs auxquels vous pouvez vous inscrire</p>
    </header>
    <main class="container my-5">
        <div class="row">
            <?php foreach ($clubs as $club): ?>
                <div class="col-md-4">
                    <div class="">
                        <div class="club-card shadow-sm">
                            <img src="<?= htmlspecialchars($club['Logo_URL'] ?: 'default_logo.png') ?>"
                                alt="Logo <?= htmlspecialchars($club['nom']) ?>" class="club-logo">
                            <div>
                                <h5><?= htmlspecialchars($club['nom']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($club['description']) ?></p>
                                <form method="post" action="index.php?action=rejoindre_club">
                                    <input type="hidden" name="club_id" value="<?= $club['id'] ?>">
                                    <button type="submit" class="btn btn-success">S'inscrire</button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>