<?php

use PHPUnit\Framework\TestCase;

class ProfileTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->createUsersTable();
        $this->createProducteursTable();

        $this->seedUsersTable();
        $this->seedProducteursTable();
    }

    protected function tearDown(): void
    {
        $this->pdo = null;
    }

    private function createUsersTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS Users (
            id INTEGER PRIMARY KEY,
            email TEXT UNIQUE,
            password TEXT,
            name TEXT,
            firstname TEXT,
            lastname TEXT,
            tel TEXT,
            location TEXT
        )");
    }

    private function createProducteursTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS Producteurs (
            id INTEGER PRIMARY KEY,
            email TEXT UNIQUE,
            password TEXT,
            name TEXT,
            profil_picture TEXT,
            description TEXT,
            raison_sociale TEXT,
            siret TEXT,
            adresse TEXT
        )");
    }

    private function seedUsersTable()
    {
        $passwordHash = password_hash('userpassword', PASSWORD_DEFAULT);
        $this->pdo->exec("INSERT INTO Users (email, password, name, firstname, lastname, tel, location) 
                          VALUES ('user@example.com', '$passwordHash', 'John Doe', 'John', 'Doe', '123456789', 'Paris')");
    }

    private function seedProducteursTable()
    {
        $passwordHash = password_hash('producteurpassword', PASSWORD_DEFAULT);
        $this->pdo->exec("INSERT INTO Producteurs (email, password, name, profil_picture, description, raison_sociale, siret, adresse) 
                          VALUES ('producteur@example.com', '$passwordHash', 'Jane Smith', 'path/to/profile_pic.jpg', 'Producteur de fruits et légumes', 'SARL Producteur', '12345678900001', '12 rue des Producteurs')");
    }

    public function testProfilePageForUser()
    {
        $_SESSION['user_id'] = 1;
        $_SESSION['user_type'] = 'user';

        ob_start();

        require_once __DIR__ . '/../view/user/profile.php';

        $output = ob_get_clean(); 

        $this->assertStringContainsString('John Doe', $output);
        $this->assertStringContainsString('user@example.com', $output);
    }

    public function testProfilePageForProducteur()
    {
        $_SESSION['user_id'] = 1;
        $_SESSION['user_type'] = 'producteur';

        ob_start();

        require_once __DIR__ . '/../view/user/profile.php';

        $output = ob_get_clean(); 

        $this->assertStringContainsString('Jane Smith', $output);
        $this->assertStringContainsString('producteur@example.com', $output);
    }
}
