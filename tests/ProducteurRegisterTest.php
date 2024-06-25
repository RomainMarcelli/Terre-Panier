<?php

use PHPUnit\Framework\TestCase;

class ProducteurRegisterTest extends TestCase
{
    public function testPageLoads()
    {
        $html = $this->getHTML(); 
        
        $this->assertStringContainsString('<form action="../controller/ProducteurRegisterController.php" method="POST">', $html);
    }

    private function getHTML()
    {
        $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Producteur Register</title>
</head>
<body>
    <form action="../controller/ProducteurRegisterController.php" method="POST">
        <label for="name">Nom entreprise</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Valider</button>
    </form>
</body>
</html>
HTML;

        return $html;
    }
}
?>
