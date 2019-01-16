<?php

use PHPUnit\Framework\TestCase;
use Archman\ByteOrder\ByteOrder;
use Archman\ByteOrder\Operator;

class OperatorTest extends TestCase
{
    public function testSetByteOrder()
    {
        ByteOrder::set(ByteOrder::LITTLE_ENDIAN);
        $this->assertEquals(ByteOrder::LITTLE_ENDIAN, ByteOrder::get());

        ByteOrder::set(ByteOrder::BIG_ENDIAN);
        $this->assertEquals(ByteOrder::BIG_ENDIAN, ByteOrder::get());
    }

    /**
     * @depends testSetByteOrder
     */
    public function testMakeByteArray()
    {
        $arr = Operator::toByteArray(0x1001, ByteOrder::LITTLE_ENDIAN);
        $expect = PHP_INT_SIZE === 8 ? "\x01\x10\x00\x00\x00\x00\x00\x00" : "\x01\x10\x00\x00";
        $this->assertEquals($expect, $arr);

        $arr = Operator::toByteArray(0x1001, ByteOrder::BIG_ENDIAN);
        $expect = PHP_INT_SIZE === 8 ? "\x00\x00\x00\x00\x00\x00\x10\x01" : "\x00\x00\x10\x01";
        $this->assertEquals($expect, $arr);
    }

    /**
     * @before
     */
    public function resetByteOrder()
    {
        ByteOrder::reset();
    }
}