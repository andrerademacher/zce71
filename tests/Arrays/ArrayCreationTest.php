<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests the edge cases of array creation.
 */
class ArrayCreationTest extends TestCase
{
    /**
     * Tests various ways of defining an array
     * @dataProvider provideDefiningAnArray
     */
    public function testDefiningAnArray(array $expected, $expression): void
    {
        self::assertSame($expected, $expression);
    }

    /**
     * PHP allows associative arrays with numeric keys and string keys.
     * Numeric keys and their string equivalent are equal and will reference to the same value.
     */
    public function provideDefiningAnArray(): Generator
    {
        yield 'traditional syntax definition' => [
            [1, 2, 3],
            array(1, 2, 3,)
        ];

        yield 'per default, numeric keys will be used, starting with 0' => [
            [0 => 1, 1 => 2, 55 => 3],
            [1, 2, 55 => 3]
        ];

        yield 'negative keys are allowed' => [
            [-1 => 1, 2 => 2, -3 => 3],
            [-1 => 1, 2 => 2, -3 => 3]
        ];

        yield 'the first default numeric key after negative keys is 0, the next default numeric key will be the highest numeric key increased by 1' => [
            [-4 => 1, 0 => 2, 5 => 3, 6 => 4],
            [-4 => 1, 2, 5 => 3, 4]
        ];

        yield 'numeric keys and their string equivalents are equal' => [
            [3 => 1, 15 => 2, 4 => 3],
            ['3' => 1, 15 => 2, '4' => 3]
        ];

        yield 'duplicate keys allow overwriting previous values' => [
            [1 => 3, 4 => 4],
            [1 => 1, 4 => 2, 1 => 3, '4' => 4]
        ];

        yield 'mixed numeric and string keys' => [
           [0 => 0, 2 => 1, 'a' => 2, '1' => 3, 3 => 4],
           [0, 2 => 1, 'a' => 2, 1 => 3, 4]
        ];
    }

}
