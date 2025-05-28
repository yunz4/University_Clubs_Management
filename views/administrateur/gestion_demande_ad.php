<?php
/*session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'administrateur') {
    header('Location: /app_gestion_clubs/index.php?action=gest_clubs');
    exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');

if (isset($_POST['id'], $_POST['action'])) {
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    if ($action === 'accepter') {
        // Valider le club
        $pdo->prepare("UPDATE club SET statut = 'valide' WHERE id = ?")->execute([$id]);

        // Récupérer l'id du responsable lié à ce club
        $stmt = $pdo->prepare("SELECT responsable_id FROM club WHERE id = ?");
        $stmt->execute([$id]);
        $club = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($club) {
            $responsable_id = $club['responsable_id'];

            // Mettre à jour responsableclub avec le club_id
            $updateStmt = $pdo->prepare("UPDATE responsableclub SET club_id = ? WHERE id_responsable = ?");
            $updateStmt->execute([$id, $responsable_id]);
        }

    } elseif ($action === 'refuser') {
        $pdo->prepare("DELETE FROM club WHERE id = ?")->execute([$id]);
    }
}

header('index.php?action=gest_clubs_admin');
exit;
*/
?> 