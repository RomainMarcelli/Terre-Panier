<?php
use PHPUnit\Framework\TestCase;

class UnlikeActionsTest extends TestCase
{
    private $pdo;
    private $stmt;

    protected function setUp(): void
    {
        $_SESSION = [
            'user_id' => 1,
            'user_type' => 'user'
        ];

        $this->pdo = $this->createMock(PDO::class);
        $this->stmt = $this->createMock(PDOStatement::class);

        $GLOBALS['pdo'] = $this->pdo;
    }

    public function testUnlikeAtelier()
    {
        $_POST = ['atelier_id' => 123];

        $this->pdo->expects($this->once())
                  ->method('prepare')
                  ->with('DELETE FROM User_Favorite_Ateliers WHERE user_id = ? AND atelier_id = ?')
                  ->willReturn($this->stmt);

        $this->stmt->expects($this->once())
                   ->method('execute')
                   ->with([$this->equalTo(1), $this->equalTo(123)])
                   ->willReturn(true);

        $this->expectOutputRegex('/liked_items.php/');

        include 'unlike_atelier.php';
    }

    public function testUnlikeProduct()
    {
        $_POST = ['product_id' => 456];

        $this->pdo->expects($this->once())
                  ->method('prepare')
                  ->with('DELETE FROM User_Favorite_Products WHERE user_id = ? AND product_id = ?')
                  ->willReturn($this->stmt);

        $this->stmt->expects($this->once())
                   ->method('execute')
                   ->with([$this->equalTo(1), $this->equalTo(456)])
                   ->willReturn(true);

        $this->expectOutputRegex('/liked_items.php/');

        include 'unlike_product.php';
    }

    public function testUnlikeProducteur()
    {
        $_POST = ['producteur_id' => 789];

        $this->pdo->expects($this->once())
                  ->method('prepare')
                  ->with('DELETE FROM User_Favorite_Producteurs WHERE user_id = ? AND producteur_id = ?')
                  ->willReturn($this->stmt);

        $this->stmt->expects($this->once())
                   ->method('execute')
                   ->with([$this->equalTo(1), $this->equalTo(789)])
                   ->willReturn(true);

        $this->expectOutputRegex('/liked_items.php/');

        include 'unlike_producteur.php';
    }

    public function testRedirectsToLoginIfNotAuthenticated()
    {
        $_SESSION = [];

        $this->expectOutputRegex('/login.php/');

        include 'unlike_atelier.php';
        include 'unlike_product.php';
        include 'unlike_producteur.php';
    }

    public function testRedirectsToLoginIfNotUser()
    {
        $_SESSION = [
            'user_id' => 1,
            'user_type' => 'admin'
        ];

        $this->expectOutputRegex('/login.php/');

        include 'unlike_atelier.php';
        include 'unlike_product.php';
        include 'unlike_producteur.php';
    }

    protected function tearDown(): void
    {
        unset($GLOBALS['pdo']);
        unset($_SESSION);
        unset($_POST);
    }
}
?>
