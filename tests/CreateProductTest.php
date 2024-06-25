<?php

use PHPUnit\Framework\TestCase;

class CreateProductTest extends TestCase
{
    public function testRedirectIfNotLoggedInAsProducer()
    {
        
        $_SESSION['user_type'] = null; 

        
        ob_start();
        require_once dirname(__DIR__, 2) . '../../mds_project/TerreOPanier/view/products/create.php'; // Chemin vers le script à tester
        $output = ob_get_clean(); 
        $this->assertStringContainsString('Location: ../connexion.php', $output());
    }

    public function testLoadCategoriesWhenLoggedInAsProducer()
    {

        $_SESSION['user_type'] = 'producteur';


        $mockCategories = [
            ['id' => 1, 'title' => 'Catégorie 1'],
            ['id' => 2, 'title' => 'Catégorie 2'],

        ];


        $categoryProductMock = $this->getMockBuilder('CategoryProduct')
                                   ->onlyMethods(['findAll'])
                                   ->getMock();

        $categoryProductMock->expects($this->once())
                            ->method('findAll')
                            ->willReturn($mockCategories);

        require_once dirname(__DIR__, 2) . '/model/CategoryProduct.php'; // Chemin vers la classe CategoryProduct
        $GLOBALS['CategoryProduct'] = $categoryProductMock;


        ob_start();
        require_once dirname(__DIR__, 2) . '/view/products/create.php';
        $output = ob_get_clean(); 


        foreach ($mockCategories as $category) {
            $this->assertStringContainsString(htmlspecialchars($category['title']), $output);
        }
    }
}
