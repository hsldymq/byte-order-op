<?php
/**
 * 覆盖字节序相关函数,为了方便在单一机器上能够测试两种字节序的情况.
 * 这里允许对机器字节序状态进行修改.
 */

namespace Archman\ByteOrder;

$orderByte = null;

function getByteOrder(): int
{
    global $orderByte;

    return $orderByte;
}

function setByteOrder(int $o)
{
    global $orderByte;

    $orderByte = $o;
}

function resetByteOrder()
{
    global $orderByte;

    if (pack('v', 0x305A) === pack('S', 0x305A)) {
        $orderByte = LITTLE_ENDIAN;
    } else {
        $orderByte = BIG_ENDIAN;
    }
}
