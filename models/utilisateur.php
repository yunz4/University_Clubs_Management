<?php
require_once __DIR__ . '/../config/database.php';

class Utilisateur
{
    public static function login($email, $password)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM utilisateur WHERE email = ? AND password = ?");
        $stmt->execute([$email, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function create($nom, $prenom, $email, $password, $role)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO utilisateur (nom, prenom, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $password, $role]);
        return $db->lastInsertId(); // retourne l'id du nouvel utilisateur
    }

    public static function checkResponsableCode($code)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM responsables_code WHERE code = ?");
        $stmt->execute([$code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function insertEtudiant($utilisateur_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO etudiant (id_utilisateur) VALUES (?)");
        $stmt->execute([$utilisateur_id]);
    }

    public static function insertResponsable($utilisateur_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO responsableclub (id_utilisateur) VALUES (?)");
        $stmt->execute([$utilisateur_id]);
    }

    public static function deleteResponsableCode($code)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM responsables_code WHERE code = ?");
        $stmt->execute([$code]);
    }

    public static function insertResponsable2($utilisateur_id)
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=gestion_clubs;charset=utf8', 'root', '');
            $stmt = $pdo->prepare("INSERT INTO responsableclub (id_utilisateur) VALUES (?)");
            return $stmt->execute([$utilisateur_id]);
        } catch (PDOException $e) {
            error_log("Erreur insertion responsable : " . $e->getMessage());
            return false;
        }
    }
    public static function generateResponsableCode()
    {
        $code = bin2hex(random_bytes(4)); // Génère un code aléatoire sécurisé (8 caractères)
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO responsables_code (code) VALUES (?)");
        $stmt->execute([$code]);
        return $code;
    }
}
?>