<?php
require_once 'inc/init.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user') {
    $user_id = $_SESSION['user_id'];
    $producteur_id = $_POST['producteur_id'];

    // Vérifiez si le producteur est déjà aimé par l'utilisateur
    $stmt = $pdo->prepare('SELECT * FROM User_Favorite_Producteurs WHERE user_id = ? AND producteur_id = ?');
    $stmt->execute([$user_id, $producteur_id]);
    $favorite = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$favorite) {
        // Ajoutez le producteur à la table User_Favorite_Producteurs
        $stmt = $pdo->prepare('INSERT INTO User_Favorite_Producteurs (user_id, producteur_id) VALUES (?, ?)');
        $stmt->execute([$user_id, $producteur_id]);
    }

    header('Location: public_producteurs.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>
