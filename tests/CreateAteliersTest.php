<?php

use PHPUnit\Framework\TestCase;

class CreateAteliersTest extends TestCase
{
    public function testRedirectIfNotLoggedInAsProducer()
    {
        $_SESSION['user_type'] = null; 
        ob_start();
        require_once dirname(__DIR__, 2) . '../../mds_project/TerreOPanier/view/ateliers/create.php'; 
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

        $categoryAteliersMock = $this->getMockBuilder('CategoryAteliers')
                                   ->onlyMethods(['findAll'])
                                   ->getMock();

        $categoryAteliersMock->expects($this->once())
                            ->method('findAll')
                            ->willReturn($mockCategories);

        require_once dirname(__DIR__, 2) . '/model/CategoryAteliers.php'; 
        $GLOBALS['CategoryAteliers'] = $categoryAteliersMock;

        ob_start();
        require_once dirname(__DIR__, 2) . '/view/ateliers/create.php'; 
        $output = ob_get_clean(); 
        foreach ($mockCategories as $category) {
            $this->assertStringContainsString(htmlspecialchars($category['title']), $output);
        }
    }
}
