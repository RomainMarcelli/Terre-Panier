<?php
require_once 'inc/init.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user') {
    $user_id = $_SESSION['user_id'];
    $atelier_id = $_POST['atelier_id'];

    // Supprimez l'atelier des favoris de l'utilisateur
    $stmt = $pdo->prepare('DELETE FROM User_Favorite_Ateliers WHERE user_id = ? AND atelier_id = ?');
    $stmt->execute([$user_id, $atelier_id]);

    header('Location: liked_items.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>
