<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../application/Controller/songs.php';

class SongsTest extends TestCase
{
    private $songs;
    private $mockModel;

    protected function setUp(): void
    {
        // Mock the model
        $this->mockModel = $this->getMockBuilder(stdClass::class)
                                ->addMethods(['getAllSongs', 'getAmountOfSongs'])
                                ->getMock();

        // Mock the Songs class and inject the mocked model
        $this->songs = $this->getMockBuilder(Songs::class)
                            ->onlyMethods(['model'])
                            ->getMock();

        $this->songs->model = $this->mockModel;
    }

    public function testIndexMethodExists()
    {
        // ตรวจสอบว่าเมธอด index มีอยู่ในคลาส Songs
        $this->assertTrue(method_exists(Songs::class, 'index'), 'Method index does not exist in Songs class.');
    }

    public function testIndexCallsModelMethods()
    {
        // Expect the model methods to be called once
        $this->mockModel->expects($this->once())
                        ->method('getAllSongs');

        $this->mockModel->expects($this->once())
                        ->method('getAmountOfSongs');

        // Call the index method
        $this->songs->index();
    }

    public function testIndexLoadsRequiredFiles()
    {
        // ตรวจสอบว่าไฟล์ที่ถูกเรียกในเมธอด index มีอยู่จริง
        $this->assertFileExists(APP . 'view/_templates/header.php', 'Header file does not exist.');
        $this->assertFileExists(APP . 'view/_templates/footer.php', 'Footer file does not exist.');
    }
}