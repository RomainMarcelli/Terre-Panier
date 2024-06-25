<?php

use PHPUnit\Framework\TestCase;

class DeleteUserTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->createUsersTable();

        $this->seedUsersTable();

        session_start();
        $_SESSION['user_id'] = 1;
        $_SESSION['user_type'] = 'user';
    }

    protected function tearDown(): void
    {
        $this->pdo = null;
        session_destroy();
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

    private function seedUsersTable()
    {
        $passwordHash = password_hash('userpassword', PASSWORD_DEFAULT);
        $this->pdo->exec("INSERT INTO Users (email, password, name, firstname, lastname, tel, location) 
                          VALUES ('user@example.com', '$passwordHash', 'John Doe', 'John', 'Doe', '123456789', 'Paris')");
    }

    public function testRedirectIfNotLoggedIn()
    {
        session_destroy();

        ob_start();

        require __DIR__ . '../../view/user/delete_account.php'; 

        $output = ob_get_clean(); 

        $this->assertStringContainsString('Location: ../connexion.php', $output);
    }

    public function testUserDeletionAndLogout()
    {
        ob_start();

        require __DIR__ . '/../../view/user/delete_account.php'; 

        $output = ob_get_clean();

        $stmt = $this->pdo->prepare('SELECT * FROM Users WHERE id = ?');
        $stmt->execute([1]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertFalse($user);
        $this->assertArrayNotHasKey('user_id', $_SESSION);
        $this->assertArrayNotHasKey('user_type', $_SESSION);

        $this->assertStringContainsString('Location: ../connexion.php', $output);
    }
}
