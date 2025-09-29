<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    // กำหนดโฟลเดอร์ที่ต้องการอัพเกรด
    $rectorConfig->paths([
        __DIR__ . '/application',
        __DIR__ . '/tests',
    ]);

    // เพิ่มกฎสำหรับการอัพเกรด PHP 7.4 -> 8.3
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_83,
    ]);
};