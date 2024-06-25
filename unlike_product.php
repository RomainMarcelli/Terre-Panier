<?php
require_once 'inc/init.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    // Supprimez le produit des favoris de l'utilisateur
    $stmt = $pdo->prepare('DELETE FROM User_Favorite_Products WHERE user_id = ? AND product_id = ?');
    $stmt->execute([$user_id, $product_id]);

    header('Location: liked_products.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>
