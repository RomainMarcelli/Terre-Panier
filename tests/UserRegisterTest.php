<?php

use PHPUnit\Framework\TestCase;

class UserRegisterTest extends TestCase
{
    public function testPageLoads()
    {
        
        ob_start();
        require_once __DIR__ . '/../view/userRegister.php';
        $output = ob_get_clean();

        
        $this->assertStringContainsString('<form action="../controller/UserRegisterController.php" method="POST">', $output);
        $this->assertStringContainsString('<select id="location" name="location" required>', $output);
        $this->assertStringContainsString('<button type="submit">Valider</button>', $output);
    }

    public function testDepartmentsAreLoaded()
    {
        
        $departments = getDepartments();

        $this->assertNotEmpty($departments);

        foreach ($departments as $department) {
            $this->assertArrayHasKey('nom', $department);
        }
    }
}

function getDepartments()
{
    $url = 'https://geo.api.gouv.fr/departements';
    $response = file_get_contents($url);
    return json_decode($response, true);
}
