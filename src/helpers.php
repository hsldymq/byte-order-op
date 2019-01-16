<?php

namespace Archman\ByteOrder;

// 小端字节序
const LITTLE_ENDIAN = 0x0;

// 大端字节序
const BIG_ENDIAN    = 0x1;

// 主机字节序
const HOST_ENDIAN   = 0x2;

if (!function_exists(__NAMESPACE__.'\\getByteOrder')) {
    /**
     * 获得当前主机的字节序.
     *
     * @return int
     */
    function getByteOrder(): int
    {
        static $order;

        if ($order === null) {
            if (pack('v', 0x305A) === pack('S', 0x305A)) {
                $order = LITTLE_ENDIAN;
            } else {
                $order = BIG_ENDIAN;
            }
        }

        return $order;
    }
}

if (!function_exists(__NAMESPACE__.'\\isLittleEndian')) {
    /**
     * 当前主机是否是小端字节序.
     *
     * @return bool
     */
    function isLittleEndian(): bool
    {
        return getByteOrder() === LITTLE_ENDIAN;
    }
}