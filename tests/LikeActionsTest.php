<?php
// LikeActionsTest.php

use PHPUnit\Framework\TestCase;

class LikeActionsTest extends TestCase
{
    private $pdo;
    private $stmt;

    protected function setUp(): void
    {
        $_SESSION = [
            'user_id' => 1,
            'user_type' => 'user'
        ];

        $this->pdo = $this->createMock(\PDO::class);
        $this->stmt = $this->createMock(\PDOStatement::class);

        $GLOBALS['pdo'] = $this->pdo;
    }

    public function testAtelierIsLiked()
    {
        $_POST = [
            'atelier_id' => 123
        ];

        $this->pdo->expects($this->exactly(2))
                  ->method('prepare')
                  ->willReturn($this->stmt);

        $this->stmt->expects($this->exactly(1))
                   ->method('execute')
                   ->with([$this->equalTo([1, 123])])
                   ->willReturn(true);

        $this->stmt->expects($this->exactly(1))
                   ->method('fetch')
                   ->willReturn(false);

        $this->stmt->expects($this->exactly(1))
                   ->method('execute')
                   ->with([$this->equalTo([1, 123])])
                   ->willReturn(true);

        $this->expectOutputRegex('/public_ateliers.php/');

        include 'like_atelier.php';
    }

    public function testProductIsLiked()
    {
        $_POST = [
            'product_id' => 456
        ];

        $this->pdo->expects($this->exactly(2))
                  ->method('prepare')
                  ->willReturn($this->stmt);

        $this->stmt->expects($this->exactly(1))
                   ->method('execute')
                   ->with([$this->equalTo([1, 456])])
                   ->willReturn(true);

        $this->stmt->expects($this->exactly(1))
                   ->method('fetch')
                   ->willReturn(false);

        $this->stmt->expects($this->exactly(1))
                   ->method('execute')
                   ->with([$this->equalTo([1, 456])])
                   ->willReturn(true);

        $this->expectOutputRegex('/public_products.php/');

        include 'like_product.php';
    }

    public function testProducteurIsLiked()
    {
        $_POST = [
            'producteur_id' => 789
        ];

        $this->pdo->expects($this->exactly(2))
                  ->method('prepare')
                  ->willReturn($this->stmt);

        $this->stmt->expects($this->exactly(1))
                   ->method('execute')
                   ->with([$this->equalTo([1, 789])])
                   ->willReturn(true);

        $this->stmt->expects($this->exactly(1))
                   ->method('fetch')
                   ->willReturn(false);

        $this->stmt->expects($this->exactly(1))
                   ->method('execute')
                   ->with([$this->equalTo([1, 789])])
                   ->willReturn(true);

        $this->expectOutputRegex('/public_producteurs.php/');

        include 'like_producteur.php';
    }

    public function testRedirectsToLoginIfNotAuthenticated()
    {
        $_SESSION = [];

        $this->expectOutputRegex('/login.php/');

        include 'like_atelier.php';
    }

    public function testRedirectsToLoginIfNotUser()
    {
        $_SESSION = [
            'user_id' => 1,
            'user_type' => 'admin'
        ];

        $this->expectOutputRegex('/login.php/');

        include 'like_atelier.php';
    }

    protected function tearDown(): void
    {
        unset($GLOBALS['pdo']);
        unset($_SESSION);
        unset($_POST);
    }
}
?>
