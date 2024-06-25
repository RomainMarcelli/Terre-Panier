<?php
require_once '../../inc/init.php'; // Ajustez le chemin selon la structure de votre projet
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'user') {
    header('Location: ../connexion.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Supprimer l'utilisateur
$stmt = $pdo->prepare('DELETE FROM Users WHERE id = ?');
$stmt->execute([$user_id]);

// Vérifiez s'il y a des erreurs SQL
if ($stmt->errorCode() != '00000') {
    $errorInfo = $stmt->errorInfo();
    die("SQL error: " . $errorInfo[2]);
}

// Déconnecter l'utilisateur après suppression
session_destroy();
header('Location: ../connexion.php');
exit;
?>
