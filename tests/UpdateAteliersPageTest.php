<?php

use PHPUnit\Framework\TestCase;

class UpdateAteliersPageTest extends TestCase
{
    public function testPageStructure()
    {
        $html = $this->getHTML();

        var_dump($html);

        $this->assertStringContainsString('<title>Modification du produit</title>', $html);
        $this->assertStringContainsString('<form action="../controller/AtelierController.php?action=update&id=<?php echo $atelier[\'id\']; ?>" method="POST">', $html);
        $this->assertStringContainsString('<input type="text" id="title" name="title" value="<?php echo htmlspecialchars($atelier[\'title\']); ?>" required>', $html);
        $this->assertStringContainsString('<input type="text" id="poids" name="poids" value="<?php echo htmlspecialchars($atelier[\'poids\']); ?>">', $html);
        $this->assertStringContainsString('<input type="text" id="price" name="price" value="<?php echo htmlspecialchars($atelier[\'price\']); ?>" required>', $html);
        $this->assertStringContainsString('<textarea name="description" id="description" placeholder="Décrire le produit"><?php echo htmlspecialchars($product[\'description\']); ?></textarea>', $html);

        $this->assertStringContainsString('<header>', $html);
        $this->assertStringContainsString('<main>', $html);
        $this->assertStringContainsString('<footer>', $html);
    }

    private function getHTML()
    {
        ob_start();

        include dirname(__DIR__, 2) . '../../mds_project/TerreOPanier/view/ateliers/update.php';

        $html = ob_get_clean();

        return $html;
    }
}
?>
