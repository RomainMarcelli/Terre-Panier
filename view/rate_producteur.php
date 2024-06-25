<?php
require_once '../inc/init.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user') {
    $user_id = $_SESSION['user_id'];
    $producteur_id = $_POST['producteur_id'];
    $rating = (int)$_POST['rating'];

    error_log("User ID: $user_id, Producteur ID: $producteur_id, Rating: $rating");

    try {
        // Vérifiez si l'utilisateur a déjà noté ce producteur
        $stmt = $pdo->prepare('SELECT * FROM User_Ratings_Producteurs WHERE user_id = ? AND producteur_id = ?');
        $stmt->execute([$user_id, $producteur_id]);
        $existingRating = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingRating) {
            // Mettre à jour la note existante
            $stmt = $pdo->prepare('UPDATE User_Ratings_Producteurs SET rating = ? WHERE user_id = ? AND producteur_id = ?');
            $stmt->execute([$rating, $user_id, $producteur_id]);
        } else {
            // Insérer une nouvelle note
            $stmt = $pdo->prepare('INSERT INTO User_Ratings_Producteurs (user_id, producteur_id, rating) VALUES (?, ?, ?)');
            $stmt->execute([$user_id, $producteur_id, $rating]);
        }

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
