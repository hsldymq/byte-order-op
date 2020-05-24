<?php

declare(strict_types=1);

namespace Archman\ByteOrder;

class Operator
{
    /**
     * 将给定的整形数字转换指定字节序的字节数组.
     *
     * @param int $from
     * @param int $toByteOrder
     *
     * @return string
     */
    public static function toByteArray(int $from, int $toByteOrder): string
    {
        if ($toByteOrder === ByteOrder::LITTLE_ENDIAN) {
            $format = PHP_INT_SIZE === 8 ? 'P' : 'V';
        } else {
            $format = PHP_INT_SIZE === 8 ? 'J' : 'N';
        }

        return pack($format, $from);
    }

    /**
     * 将指定的整型数字按照指定的字节序进行重排列得到新的整型数字.
     *
     * 例如当前机器小端字节序,那么对数字128(0b 10000000 00000000 .... 00000000)变换为大端字节序,将得到PHP_INT_MIN(0b 00000000 .... 10000000)
     *
     * @param int $from
     * @param int $toByteOrder
     *
     * @return int
     */
    public static function transformInt(int $from, int $toByteOrder): int
    {
        $result = $from;

        $order = ByteOrder::get();
        if ($order === ByteOrder::LITTLE_ENDIAN && $toByteOrder === ByteOrder::BIG_ENDIAN) {
            $format = PHP_INT_SIZE === 8 ? 'P' : 'V';
        } else if ($order === ByteOrder::BIG_ENDIAN && $toByteOrder === ByteOrder::LITTLE_ENDIAN) {
            $format = PHP_INT_SIZE === 8 ? 'J' : 'N';
        }

        if (isset($format)) {
            $byteArr = self::toByteArray($from, $toByteOrder);
            $result = unpack("{$format}result", $byteArr)['result'];
        }

        return $result;
    }
}