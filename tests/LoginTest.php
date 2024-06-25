<?php

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        // Configuration de la connexion PDO pour les tests
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Création des tables et insertion des données de test
        $this->pdo->exec("CREATE TABLE Users (id INTEGER PRIMARY KEY, email TEXT, password TEXT)");
        $this->pdo->exec("CREATE TABLE Producteurs (id INTEGER PRIMARY KEY, email TEXT, password TEXT)");

        // Insertion d'un utilisateur de test
        $passwordHash = password_hash('userpassword', PASSWORD_DEFAULT);
        $this->pdo->exec("INSERT INTO Users (email, password) VALUES ('user@example.com', '$passwordHash')");

        // Insertion d'un producteur de test
        $passwordHash = password_hash('producteurpassword', PASSWORD_DEFAULT);
        $this->pdo->exec("INSERT INTO Producteurs (email, password) VALUES ('producteur@example.com', '$passwordHash')");
    }

    public function testUserLogin()
    {
        $_POST['email'] = 'user@example.com';
        $_POST['password'] = 'userpassword';

        ob_start();
        session_start(); // Démarrage de la session pour les tests
        $_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__); // Définit le document root pour les chemins relatifs
        require './view/connexion.php';
        ob_end_clean();

        // Vérification des valeurs de session
        $this->assertEquals('user', $_SESSION['user_type']);
        $headers = headers_list();
        $this->assertContains('Location: ./profile.php', $headers);
    }

    public function testProducteurLogin()
    {
        $_POST['email'] = 'producteur@example.com';
        $_POST['password'] = 'producteurpassword';

        ob_start();
        session_start(); 
        $_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__); 
        require './view/connexion.php';
        ob_end_clean();

        $this->assertEquals('producteurs', $_SESSION['user_type']);
        $headers = headers_list();
        $this->assertContains('Location: ./dashboard.php', $headers);
    }

    public function testInvalidLogin()
    {
        $_POST['email'] = 'invalid@example.com';
        $_POST['password'] = 'invalidpassword';

        ob_start();
        session_start(); 
        $_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__); 
        require './view/connexion.php';
        $output = ob_get_clean();

        $this->assertFalse(isset($_SESSION['user_type']));
        $this->assertStringContainsString('Invalid email or password', $output);
    }
}
