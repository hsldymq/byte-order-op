<?php

use PHPUnit\Framework\TestCase;
use Archman\ByteOrder\ByteOrder;

class OperatorTest extends TestCase
{
    public function testSetByteOrder()
    {
        ByteOrder::set(ByteOrder::LITTLE_ENDIAN);
        $this->assertEquals(ByteOrder::LITTLE_ENDIAN, ByteOrder::get());

        ByteOrder::set(ByteOrder::BIG_ENDIAN);
        $this->assertEquals(ByteOrder::BIG_ENDIAN, ByteOrder::get());
    }
}