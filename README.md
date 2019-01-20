# 字节序操作工具

**用于将数据在小端和大端存储之间转换.**

例如当前机器为64位小端机器,对于整型数字127,在内存中存储结构为:

`01111111 00000000 00000000 00000000 00000000 00000000 00000000 00000000`

转换为大端后,数字变为9151314442816847872, 内存中存储为:

`00000000 00000000 00000000 00000000 00000000 00000000 00000000 01111111`


## Examples

```php
    use Archman\ByteOrder\ByteOrder;
    
    // 获得当前机器字节序
    // $bo的值只有两种: ByteOrder::LITTLE_ENDIAN和ByteOrder::BIG_ENDIAN
    $bo = ByteOrder::get();  
```

```php
    use Archman\ByteOrder\ByteOrder;
    
    // 等同于 ByteOrder::get() === ByteOrder::LITTLE_ENDIAN
    if (ByteOrder::isLittleEndian()) {
        // ...
    }
     
```

```php
    use Archman\ByteOrder\ByteOrder;
    use Archman\ByteOrder\Operator;
    
    // 将该值(此处为127)转换为小端字节数组表示, 无论当前机器为小端还是大端
    // 于是其输出应该为(从左到右为低字节到高字节):
    // 64位机器: 0x7F 0x00 0x00 0x00 0x00 0x00 0x00 0x00
    // 32位机器: 0x7F 0x00 0x00 0x00
    $byteArrLE = Operator::toByteArray(127, ByteOrder::LITTLE_ENDIAN);
    if (PHP_INT_SIZE === 8) {
        assert($byteArrLE === "\x7F\x00\x00\x00\x00\x00\x00\x00");
    } else {
        assert($byteArrLE === "\x7F\x00\x00\x00");
    }
    
    
    // 输出应该为(从左到右为低字节到高字节):
    // 64位机器: 0x00 0x00 0x00 0x00 0x00 0x00 0x00 0x7F
    // 32位机器: 0x00 0x00 0x00 0x7F
    $byteArrBE = Operator::toByteArray(127, ByteOrder::BIG_ENDIAN);
    if (PHP_INT_SIZE === 8) {
        assert($byteArrLE === "\x00\x00\x00\x00\x00\x00\x00\x7F");
    } else {
        assert($byteArrLE === "\x00\x00\x00\x7F");
    }
```

```php
    use Archman\ByteOrder\ByteOrder;
    use Archman\ByteOrder\Operator;
    
    // 假设当前机器为小端64位
    // 127在内中存储方式为: 0x7F 0x00 0x00 0x00 0x00 0x00 0x00 0x00
    // 此方法将转换大端存储,将内存中顺序对调得到: 0x00 0x00 0x00 0x00 0x00 0x00 0x00 0x7F
    // 即输出为9151314442816847872
    // 大端或32位同理
    $intLE = Operator::transformInt(127, ByteOrder::BIG_ENDIAN);
```