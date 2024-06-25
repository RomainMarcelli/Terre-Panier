<?php
require_once '../inc/init.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user') {
    $user_id = $_SESSION['user_id'];
    $atelier_id = $_POST['id'];
    $rating = (int)$_POST['rating'];

    try {
        // Vérifiez si l'utilisateur a déjà noté cet atelier
        $stmt = $pdo->prepare('SELECT * FROM User_Ratings_Ateliers WHERE user_id = ? AND atelier_id = ?');
        $stmt->execute([$user_id, $atelier_id]);
        $existingRating = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingRating) {
            // Mettre à jour la note existante
            $stmt = $pdo->prepare('UPDATE User_Ratings_Ateliers SET rating = ? WHERE user_id = ? AND atelier_id = ?');
            $stmt->execute([$rating, $user_id, $atelier_id]);
        } else {
            // Insérer une nouvelle note
            $stmt = $pdo->prepare('INSERT INTO User_Ratings_Ateliers (user_id, atelier_id, rating) VALUES (?, ?, ?)');
            $stmt->execute([$user_id, $atelier_id, $rating]);
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
