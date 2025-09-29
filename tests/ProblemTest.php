<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../application/Controller/problem.php';

class ProblemTest extends TestCase
{
    public function testIndexMethodExists()
    {
        // ตรวจสอบว่าเมธอด index มีอยู่ในคลาส Problem
        $this->assertTrue(method_exists(Problem::class, 'index'), 'Method index does not exist in Problem class.');
    }

    public function testIndexLoadsRequiredFiles()
    {
        // Mock the Controller class (ถ้าจำเป็น)
        $mockController = $this->getMockBuilder(Controller::class)
                               ->disableOriginalConstructor()
                               ->getMock();

        // สร้างอินสแตนซ์ของคลาส Problem
        $problem = new Problem();

        // ตรวจสอบว่าไฟล์ที่ถูกเรียกในเมธอด index มีอยู่จริง
        $this->assertFileExists(APP . 'view/_templates/header.php', 'Header file does not exist.');
        $this->assertFileExists(APP . 'view/problem/index.php', 'Problem index file does not exist.');
        $this->assertFileExists(APP . 'view/_templates/footer.php', 'Footer file does not exist.');
    }
}