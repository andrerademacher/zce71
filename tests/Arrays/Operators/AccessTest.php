<?php

declare(strict_types=1);

namespace Zce71\Arrays\Operators;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests edge cases with $array[$key].
 */
class AccessTest extends TestCase
{
    /**
     * @dataProvider provideWriteAtIndex
     */
    public function testWriteAtIndex(array $expected, array $input, $key, $value): void
    {
        $input[$key] = $value;
        self::assertSame($expected, $input);
    }

    /**
     * Provides test data for testWriteAtIndex.
     */
    public function provideWriteAtIndex(): Generator
    {
        /**
         * Simple example, writing the value "world" in an empty array at the key "hello".
         */
        yield 'simple example' => [
            ['hello' => 'world'],
            [],
            'hello',
            'world'
        ];

        /**
         * Overwriting the value 1 at the existing key 1 with the value 2.
         */
        yield 'overwrite existing value' => [
            [1 => 2],
            [1 => 1],
            1,
            2,
        ];

        /**
         * Because (string)1 === (string)'1', both keys are considered equal, so the value of 1 is overwritten with the value 2.
         */
        yield 'overwriting a numeric key with a string key' => [
            [1 => 2],
            [1 => 1],
            '1',
            2,
        ];

        /**
         * Float keys are cast to integer numeric keys.
         */
        yield 'float keys are cast to integer numeric keys' => [
            [1 => 1, 0 => 2],
            [1 => 1],
            0.75,
            2,
        ];

        /**
         * Float keys are cast to integer numeric keys.
         */
        yield 'overwriting an existing key with a float key' => [
            [1 => 2],
            [1 => 1],
            1.98,
            2,
        ];
    }
}
