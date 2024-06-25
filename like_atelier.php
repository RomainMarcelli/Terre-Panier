<?php
require_once 'inc/init.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user') {
    $user_id = $_SESSION['user_id'];
    $atelier_id = $_POST['atelier_id'];

    // Vérifiez si l'atelier est déjà aimé par l'utilisateur
    $stmt = $pdo->prepare('SELECT * FROM User_Favorite_Ateliers WHERE user_id = ? AND atelier_id = ?');
    $stmt->execute([$user_id, $atelier_id]);
    $favorite = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$favorite) {
        // Ajoutez l'atelier à la table User_Favorite_Ateliers
        $stmt = $pdo->prepare('INSERT INTO User_Favorite_Ateliers (user_id, atelier_id) VALUES (?, ?)');
        $stmt->execute([$user_id, $atelier_id]);
    }

    header('Location: public_ateliers.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>
