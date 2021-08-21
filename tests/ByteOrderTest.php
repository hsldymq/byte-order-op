<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Archman\ByteOrder\ByteOrder;

class ByteOrderTest extends TestCase
{
    public function testGetByteOrder()
    {
        system("which python", $result);
        if ($result !== 0) {
            $this->markTestSkipped('needs python');
        }

        $byteOrder = ByteOrder::get();
        $pyBO = trim(exec("python -c 'import sys;print(sys.byteorder)'"));
        if ($pyBO === 'little') {
            $this->assertEquals(ByteOrder::LITTLE_ENDIAN, $byteOrder);
        } else {
            $this->assertEquals(ByteOrder::BIG_ENDIAN, $byteOrder);
        }
    }
}