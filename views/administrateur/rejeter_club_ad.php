<?php
/*session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'administrateur') {
    header('Location: /index.php?action=gest_clubs');
    exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');

if (isset($_POST['id'], $_POST['action']) && $_POST['action'] === 'rejeter_club') {
    $id = intval($_POST['id']);

    // Commencer transaction
    $pdo->beginTransaction();

    try {
        // Détacher les responsables liés à ce club
        $stmt = $pdo->prepare("UPDATE responsableclub SET club_id = NULL WHERE club_id = ?");
        $stmt->execute([$id]);

        // Supprimer le club
        $stmt = $pdo->prepare("DELETE FROM club WHERE id = ?");
        $stmt->execute([$id]);

        // Valider la transaction
        $pdo->commit();

    } catch (Exception $e) {
        // Annuler en cas d’erreur
        $pdo->rollBack();
        die("Erreur lors du rejet du club : " . $e->getMessage());
    }
}

header('Location: /app_gestion_clubs/views/administrateur/gest_clubs.php');
exit; */