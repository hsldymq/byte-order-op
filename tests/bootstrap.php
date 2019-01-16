<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/ByteOrderMock.php';
class_alias("ByteOrderMock", "Archman\\ByteOrder\\ByteOrder", false);

\Archman\ByteOrder\ByteOrder::reset();