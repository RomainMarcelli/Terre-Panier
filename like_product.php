<?php
require_once 'inc/init.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    // Vérifiez si le produit est déjà aimé par l'utilisateur
    $stmt = $pdo->prepare('SELECT * FROM User_Favorite_Products WHERE user_id = ? AND product_id = ?');
    $stmt->execute([$user_id, $product_id]);
    $favorite = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$favorite) {
        // Ajoutez le produit à la table User_Favorite_Products
        $stmt = $pdo->prepare('INSERT INTO User_Favorite_Products (user_id, product_id) VALUES (?, ?)');
        $stmt->execute([$user_id, $product_id]);
    }

    header('Location: public_products.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>
