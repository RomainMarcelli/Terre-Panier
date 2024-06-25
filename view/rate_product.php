<?php
require_once '../inc/init.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $rating = (int)$_POST['rating'];

    try {
        $stmt = $pdo->prepare('SELECT * FROM User_Ratings_Products WHERE user_id = ? AND product_id = ?');
        $stmt->execute([$user_id, $product_id]);
        $existingRating = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingRating) {
            $stmt = $pdo->prepare('UPDATE User_Ratings_Products SET rating = ? WHERE user_id = ? AND product_id = ?');
            $stmt->execute([$rating, $user_id, $product_id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO User_Ratings_Products (user_id, product_id, rating) VALUES (?, ?, ?)');
            $stmt->execute([$user_id, $product_id, $rating]);
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
