<?php
class Database {
    public static function connect() {
        try {
            $db="gestion_clubs";
            $user="root";
            $pwd="";
            $pdo = new PDO("mysql:host=localhost;dbname=$db", $user, $pwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connexion échouée : " . $e->getMessage());
        }
    }
}
?>