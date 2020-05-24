<?php

declare(strict_types=1);

namespace Archman\ByteOrder;

class ByteOrder
{
    // 小端字节序
    const LITTLE_ENDIAN = 0x0;

    // 大端字节序
    const BIG_ENDIAN    = 0x1;

    public static function get(): int
    {
        static $order;

        if ($order === null) {
            if (pack('v', 0x305A) === pack('S', 0x305A)) {
                $order = self::LITTLE_ENDIAN;
            } else {
                $order = self::BIG_ENDIAN;
            }
        }

        return $order;
    }

    /**
     * 当前主机是否是小端字节序.
     *
     * @return bool
     */
    public static function isLittleEndian(): bool
    {
        return self::get() === self::LITTLE_ENDIAN;
    }
}