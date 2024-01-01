<?php

namespace Tests;

final class TestData
{
    public static function makeValidShortParams(): array
    {
        return [
            'name' => 'a',
            'email' => 'b@c',
            'tel' => str_repeat('0', 10),
            'content' => '',
        ];
    }

    public static function makeValidLongParams(): array
    {
        return [
            'name' => str_repeat('a', 255),
            'email' => str_repeat('b', 64) . '@' . str_repeat('c', 63),
            'tel' => str_repeat('9', 11),
            'content' => str_repeat(str_repeat('あ', 100) . PHP_EOL, 100),
        ];
    }

    public static function makeValidParamsList(): array
    {
        return [
            self::makeValidShortParams(),
            self::makeValidLongParams(),
        ];
    }
}
