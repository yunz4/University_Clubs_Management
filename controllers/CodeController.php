<?php
require_once(__DIR__ . '/../models/utilisateur.php');

class CodeController
{
    public function genererCode()
    {
        if ($_SESSION['user']['role'] !== 'administrateur') {
            header('Location: index.php?action=login');
            exit;
        }

        $code = Utilisateur::generateResponsableCode();
        include 'views/administrateur/code_generer.php';
    }
}
?>