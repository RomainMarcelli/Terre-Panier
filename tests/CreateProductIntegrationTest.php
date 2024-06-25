<?php

use PHPUnit\Framework\TestCase;

class CreateProductIntegrationTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        session_start();

        $_SESSION['user_id'] = 1;
        $_SESSION['user_type'] = 'producteur';

        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=terreopanier', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Could not connect to the database: ' . $e->getMessage());
        }

        if (!class_exists('CategoryProduct')) {
            require_once __DIR__ . '/CategoryProductStub.php';
        }
    }

    public function testCreateProductPageIntegration()
    {
        ob_start();

        $filePath = realpath(dirname(__DIR__) . '/view/products/create.php');
        if ($filePath === false) {
            ob_end_clean();
            $this->fail('Le chemin vers le fichier create.php est incorrect');
        }

        include $filePath;
        $output = ob_get_clean();

        echo "Captured output: " . $output;

        $this->assertStringContainsString('<form action="../../controller/ProductController.php?action=create" method="POST">', $output);

        $mockCategories = [
            ['id' => 1, 'title' => 'Fruits'],
            ['id' => 2, 'title' => 'Légumes'],
            ['id' => 3, 'title' => 'Viandes']
        ];

        foreach ($mockCategories as $category) {
            $this->assertStringContainsString('<option value="' . htmlspecialchars($category['id']) . '">' . htmlspecialchars($category['title']) . '</option>', $output);
        }
    }

    protected function tearDown(): void
    {
        session_unset();
        session_destroy();
    }
}

?>
