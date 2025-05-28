<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'responsable') {
    header('Location: index.php?action=login');
    exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$description = $_POST['description'];

$user_id = $_SESSION['user']['id_utilisateur'];

// Récupérer l'ID du responsable lié à cet utilisateur
// Before checking for responsable
$stmt = $pdo->prepare("SELECT id_responsable FROM responsableclub WHERE id_utilisateur = ?");
$stmt->execute([$user_id]);
$responsable = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$responsable) {
    // Auto-create responsable entry (only for debugging!)
    $stmt = $pdo->prepare("INSERT INTO responsableclub (id_utilisateur) VALUES (?)");
    $stmt->execute([$user_id]);
    $responsable_id = $pdo->lastInsertId();
} else {
    $responsable_id = $responsable['id_responsable'];
}

// Gérer le fichier logo (optionnel)
$logoPath = null;
if (!empty($_FILES['logo_url']['name'])) {
    $targetDir = "uploads/logos/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    $filename = basename($_FILES["logo_url"]["name"]);
    $targetFilePath = $targetDir . uniqid() . "-" . $filename;

    if (move_uploaded_file($_FILES["logo_url"]["tmp_name"], $targetFilePath)) {
        $logoPath = $targetFilePath;
    }
}

// Insérer la demande dans la base de données (statut "en_attente")
$stmt = $pdo->prepare("INSERT INTO club (nom, description, responsable_id, logo_url, statut) VALUES (?, ?, ?, ?, 'en_attente')");
$stmt->execute([$nom, $description, $responsable_id, $logoPath]);

// Redirection
header('Location: index.php?action=creer_club&message=demande_envoyee');
exit;
?>