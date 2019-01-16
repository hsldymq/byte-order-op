<?php
/**
 * 覆盖字节序相关函数,为了方便在单一机器上能够测试两种字节序的情况.
 * 这里允许对机器字节序状态进行修改.
 */

class ByteOrderMock
{
    // 小端字节序
    const LITTLE_ENDIAN = 0x0;

    // 大端字节序
    const BIG_ENDIAN    = 0x1;

    // 主机字节序
    const HOST_ENDIAN   = 0x2;

    private static $byteOrder;

    public static function get()
    {
        return self::$byteOrder;
    }

    public static function set(int $byteOrder)
    {
        self::$byteOrder = $byteOrder;
    }

    public static function reset()
    {
        static $order;

        if ($order === null) {
            if (pack('v', 0x305A) === pack('S', 0x305A)) {
                $order = self::LITTLE_ENDIAN;
            } else {
                $order = self::BIG_ENDIAN;
            }
        }

        self::$byteOrder = $order;
    }

    public static function isLittleEndian(): bool
    {
        return self::get() === self::LITTLE_ENDIAN;
    }
}