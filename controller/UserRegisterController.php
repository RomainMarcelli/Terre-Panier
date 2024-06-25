<?php

require_once '../model/User.php';

class UserRegisterController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $location = $_POST['location'];

            $user = new User($firstname, $lastname, $email, $password, $location);
            if ($user->save()) {
                header('Location: /mds_project/TerreOPanier/view/userLogin.php'); // Assurez-vous que ce chemin est correct
                exit;
            } else {
                $msg = 'Error registering user';
                require '../view/userRegister.php';
            }
        } else {
            require '../view/userRegister.php';
        }
    }
}

session_start();
$controller = new UserRegisterController();
$controller->register();

?>
