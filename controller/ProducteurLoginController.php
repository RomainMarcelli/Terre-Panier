<?php

require_once '../model/Producteur.php';

class ProducteurLoginController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $producteur = Producteur::findByEmail($email);

            if ($producteur && password_verify($password, $producteur['password'])) {
                $_SESSION['producteur_id'] = $producteur['id'];
                header('Location: /cours-mds/DigitalProject/dashboard.php'); // Assurez-vous que ce chemin est correct
                exit;
            } else {
                $msg = 'Invalid email or password';
                require '../view/producteurLogin.php';
            }
        } else {
            require '../view/producteurLogin.php';
        }
    }
}

session_start();
$controller = new ProducteurLoginController();
$controller->login();

?>
