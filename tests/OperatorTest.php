<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Archman\ByteOrder\ByteOrder;
use Archman\ByteOrder\Operator;

class OperatorTest extends TestCase
{
    public function testMakeByteArray()
    {
        $is64 = PHP_INT_SIZE === 8;

        $arr = Operator::toByteArray(0x1001, ByteOrder::LITTLE_ENDIAN);
        $expect = $is64 ? "\x01\x10\x00\x00\x00\x00\x00\x00" : "\x01\x10\x00\x00";
        $this->assertEquals($expect, $arr);

        $arr = Operator::toByteArray(0x1001, ByteOrder::BIG_ENDIAN);
        $expect = $is64 ? "\x00\x00\x00\x00\x00\x00\x10\x01" : "\x00\x00\x10\x01";
        $this->assertEquals($expect, $arr);
    }

    /**
     * @depends testMakeByteArray
     */
    public function testTransformInt()
    {
        $isLittleEndian = ByteOrder::isLittleEndian();
        $is64 = PHP_INT_SIZE === 8;

        $expect = $is64 ? 0x3031000000000000 : 0x30310000;
        $toByteOrder = $isLittleEndian ? ByteOrder::BIG_ENDIAN : ByteOrder::LITTLE_ENDIAN;
        $this->assertEquals($expect, Operator::transformInt(0x3130, $toByteOrder));
    }
}