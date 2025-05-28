<?php
require_once(__DIR__ . '/../models/ressource.php');

class RessourceController
{
    public function ajouterRessource()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom_ressource'] ?? '';
            $type = $_POST['type_ressource'] ?? 'autre';
            $quantite = $_POST['quantite'] ?? 1;
            $disponibilite = $_POST['disponibilite'] ?? 'disponible';
            $club_id = null; // à ajuster si tu as l'id du club

            Ressource::ajouter($nom, $type, $quantite, $club_id, $disponibilite);

            header('Location: index.php?action=ressources'); // ou autre redirection
            exit;
        }
    }
    public function afficherRessources()
    {
        $ressources = Ressource::getAll(); // Récupère toutes les ressources depuis la BD
        require_once(__DIR__ . '/../views/administrateur/gerer_ressource_ad.php');
    }

    public function supprimerRessource()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_ressource'] ?? null;
            if ($id) {
                Ressource::supprimer($id);
            }
            // Après suppression, redirige vers la liste des ressources
            header('Location: index.php?action=ressources');
            exit;
        }
    }

}