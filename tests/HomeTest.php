<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../application/Controller/home.php';

class HomeTest extends TestCase
{
    public function testIndex()
    {
        // Mock the Controller class if needed
        $mockController = $this->getMockBuilder(Controller::class)
                               ->disableOriginalConstructor()
                               ->getMock();

        // Create an instance of the Home class
        $home = new Home();

        // Assert that the index method exists
        $this->assertTrue(method_exists($home, 'index'), 'Method index does not exist in Home class.');

        // Since the index method includes files, you can test if the files exist
        $this->assertFileExists(APP . 'view/_templates/header.php');
        $this->assertFileExists(APP . 'view/home/index.php');
        $this->assertFileExists(APP . 'view/_templates/footer.php');
    }
}