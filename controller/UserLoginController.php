<?php

require_once '../model/User.php';

class UserLoginController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /mds_project/TerreOPanier/dashboard.php'); // Assurez-vous que ce chemin est correct
                exit;
            } else {
                $msg = 'Invalid email or password';
                require '../view/userLogin.php';
            }
        } else {
            require '../view/userLogin.php';
        }
    }
}

// Vérifiez si une session est déjà active avant de démarrer une nouvelle session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$controller = new UserLoginController();
$controller->login();

?>
