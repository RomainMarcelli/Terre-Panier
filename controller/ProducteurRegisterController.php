<?php
require_once '../inc/init.php';

// Vérifiez si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $location = $_POST['location'];
    $profil_picture = '';
    $cover_picture = '';
    $description = $_POST['description'];
    $raison_sociale = $_POST['raison_sociale'];
    $siret = $_POST['siret'];
    $adresse = $_POST['adresse'];

    // Vérifiez et téléchargez les images de profil et de couverture
    $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/jpg'];
    if (isset($_FILES['profil_picture']) && $_FILES['profil_picture']['error'] == 0) {
        $fileTmpPath = $_FILES['profil_picture']['tmp_name'];
        $fileMimeType = mime_content_type($fileTmpPath);
        if (in_array($fileMimeType, $allowedMimeTypes)) {
            $profil_picture = 'uploads/' . basename($_FILES['profil_picture']['name']);
            move_uploaded_file($fileTmpPath, $profil_picture);
        } else {
            die('Invalid file type for profile picture.');
        }
    }

    if (isset($_FILES['cover_picture']) && $_FILES['cover_picture']['error'] == 0) {
        $fileTmpPath = $_FILES['cover_picture']['tmp_name'];
        $fileMimeType = mime_content_type($fileTmpPath);
        if (in_array($fileMimeType, $allowedMimeTypes)) {
            $cover_picture = 'uploads/' . basename($_FILES['cover_picture']['name']);
            move_uploaded_file($fileTmpPath, $cover_picture);
        } else {
            die('Invalid file type for cover picture.');
        }
    }

    // Insérez le producteur dans la base de données
    $stmt = $pdo->prepare('INSERT INTO Producteurs (name, email, tel, password, location, profil_picture, cover_picture, description, raison_sociale, siret, adresse) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$name, $email, $tel, $password, $location, $profil_picture, $cover_picture, $description, $raison_sociale, $siret, $adresse]);

    header('Location: ../dashboard.php');
    exit;
}
?>
