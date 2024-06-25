<?php
use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__) . '../../TerreOPanier/controller/AtelierController.php';

class AtelierControllerTest extends TestCase
{
    protected function setUp(): void
    {
        session_start();
        $_SESSION['user_type'] = 'producteur';
    }

    public function testCreateActionSuccess()
    {
        $atelierMock = $this->createMock(Atelier::class);
        $controller = new AtelierController($atelierMock);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'title' => 'Atelier Test',
            'type' => 'Type Test',
            'location' => 'Location Test',
            'price' => 50,
            'place' => 'Place Test',
            'pictures' => 'Pictures Test',
            'description' => 'Description Test',
            'time' => 'Time Test',
            'date' => '2024-06-30',
            'producteur_id' => 1,
            'category_ateliers_id' => 1,
        ];

        $atelierMock->expects($this->once())
                    ->method('save')
                    ->willReturn(true);

        try {
            ob_start();
            $controller->create();
            ob_end_clean();
        } catch (\Exception $e) {
            $this->fail('Exception thrown: ' . $e->getMessage());
        }
    }

    protected function tearDown(): void
    {
        session_unset();
        $_SESSION = [];
        $_POST = [];
    }
}
?>
