<?php
// PageStructureTest.php

use PHPUnit\Framework\TestCase;

class PageStructureTest extends TestCase
{
    public static function pageTitleProvider()
    {
        return [
            ['cremerie.php', '<title>Crémerie</title>'],
            ['viande.php', '<title>Viande & Charcuteries</title>'],
            ['boisson.php', '<title>Boissons</title>'],
            ['epicerie.php', '<title>Epicerie</title>'],
            ['fruit.php', '<title>Fruits & Légumes</title>'],
            ['poissons.php', '<title>Poisson & Fruits de mer</title>'],
        ];
    }


    public function testPageStructure($page, $expectedTitle)
    {
        ob_start();

        $pdo = $this->createMock(PDO::class);

        include __DIR__ . "../../view/productPages/$page";
        $output = ob_get_clean();

        $this->assertStringContainsString($expectedTitle, $output);

        while (ob_get_level() > 0) {
            ob_end_clean();
        }
    }
}
?>
