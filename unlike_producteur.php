<?php
require_once 'inc/init.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user') {
    $user_id = $_SESSION['user_id'];
    $producteur_id = $_POST['producteur_id'];

    // Supprimez le producteur des favoris de l'utilisateur
    $stmt = $pdo->prepare('DELETE FROM User_Favorite_Producteurs WHERE user_id = ? AND producteur_id = ?');
    $stmt->execute([$user_id, $producteur_id]);

    header('Location: liked_items.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>
