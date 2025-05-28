<?php
require_once 'models/utilisateur.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = Utilisateur::login($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                if($_SESSION['user']['role'] == 'etudiant'){
                    header('Location: index.php?action=etudiant_dashboard');
                    exit;
                }
                if($_SESSION['user']['role'] == 'responsable'){
                    header('Location: index.php?action=responsable_dashboard');
                    exit;
                }
                if($_SESSION['user']['role'] == 'administrateur'){
                    header('Location: index.php?action=administrateur_dashboard');
                    exit;
                }
            } else {
                $error = "Identifiants incorrects";
                include 'views/login.php';
            }
        } else {
            include 'views/login.php';
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom=$_POST['prenom'];
            $email = $_POST['email'];
            $role = $_POST['user_type'];
            $password = $_POST['password'];

            

            if ($role === 'etudiant') {
                $user_id = Utilisateur::create($nom,$prenom, $email, $password, $role);
                Utilisateur::insertEtudiant($user_id);
            } elseif ($role === 'responsable') {
                $code = $_POST['responsable_code'];
                $codeValid = Utilisateur::checkResponsableCode($code);
                if ($codeValid) {
                    $user_id = Utilisateur::create($nom,$prenom, $email, $password, $role);
                    Utilisateur::insertResponsable2($user_id);
                    Utilisateur::deleteResponsableCode($code);
                } else {
                    $error = "Code responsable invalide.";
                    echo $error;
                    include 'views/login.php';
                    return;
                }
            }

            header('Location: index.php?action=login');
            exit;
        } else {
            include 'views/login.php';
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
    }
}
?>