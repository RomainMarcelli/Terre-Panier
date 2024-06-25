<?php
// Connexion à la base de données
$host = 'mysql:host=localhost;dbname=terreopanier'; // Changez les paramètres selon votre configuration
$login = 'root'; // Login de connexion au serveur de BDD
$password = ''; // MDP, vide sur XAMPP et WAMP, root sur MAMP
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Changer WARNING en EXCEPTION pour attraper les erreurs
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Variable permettant d'afficher les messages utilisateur
$msg = '';

// On crée ou on ouvre la session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
