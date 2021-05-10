<?php

declare(strict_types=1);

namespace Zce71\Arrays\Operator;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests the identity ("==") operator's behaviour on arrays.
 */
class EqualityTest extends TestCase
{
    /**
     * Tests array1 == array2. Just 2 arrays.
     * @dataProvider provideEqualityWithTwoArrays
     */
    public function testEqualityWithTwoArrays(bool $expected, array $array1, array $array2): void
    {
        self::assertSame($expected, $array1 == $array2);
    }

    public function provideEqualityWithTwoArrays(): Generator
    {
        yield 'empty arrays are equal' => [
            true, [], []
        ];

        yield 'arrays with a different single value equal to false are equal, false and null' => [
            true, [false], [null]
        ];

        yield 'arrays with a different single value equal to false are equal, 0 and null' => [
            true, [0], [null]
        ];

        yield 'arrays with a different single value equal to false are equal, 0 and false' => [
            true, [0], [false]
        ];

        yield 'arrays with the same value are equal' => [
            true, [22], [22]
        ];

        yield 'arrays with the same key-value pair are equal (and identical)' => [
            true, [2 => 'c'], [2 => 'c']
        ];

        yield 'arrays with the same key, but different value (equal to false) are equal' => [
            true, [2 => false], [2 => null]
        ];

        yield 'arrays with same key-value pairs, but with different order, are equal (but not identical)' => [
            true, [0 => 'a', 1 => 'b', 2 => 'c',], [1 => 'b', 2 => 'c', 0 => 'a',]
        ];

        yield 'empty array and array containing the value null are not equal' => [
            false, [], [null]
        ];

        yield 'arrays with the same single value, but different key not are equal' => [
            false, [1 => 'c'], [2 => 'c']
        ];
    }

    /**
     * Tests $array == $value2.
     * @dataProvider provideEquality
     */
    public function testEquality(bool $expected, array $array, $value2): void
    {
        self::assertSame($expected, $array == $value2);
    }

    public function provideEquality(): Generator
    {
        yield 'empty array and null are equal' => [
            true, [], null
        ];

        yield 'empty array and false are equal' => [
            true, [], false
        ];

        yield 'empty array and empty string are not equal' => [
            false, [], ''
        ];

        yield 'empty array and 0 are not equal' => [
            false, [], 0
        ];

        yield 'empty array and "0" are not equal' => [
            false, [], '0'
        ];

        yield 'array with single int value and the int value itself are not equal' => [
            false, [2], 2
        ];
    }
}
