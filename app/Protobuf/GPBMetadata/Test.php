<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: test.proto

namespace GPBMetadata;

class Test
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(hex2bin(
            "0a3f0a0a746573742e70726f746f1202706222250a0a68656c6c6f776f72" .
            "6c64120a0a026964180120012805120b0a03737472180220012809620670" .
            "726f746f33"
        ));

        static::$is_initialized = true;
    }
}
