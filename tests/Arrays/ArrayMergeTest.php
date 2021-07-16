<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests the array_merge() method's edge cases.
 * @see https://www.php.net/manual/en/function.array-merge.php
 *
 * Merging arrays without string keys will ignore the keys and return an array containing all the values in the given order with default numeric keys starting at 0.
 * String keys, that can be converted into an (integer) numeric key, will be ignored and replaced with default numeric keys.
 */
class ArrayMergeTest extends TestCase
{
    /**
     * Tests the array_merge() method with 2 arrays only.
     * @dataProvider provideArrayMergeWithTwoArrays
     */
    public function testArrayMergeWithTwoArrays(array $expected, array $array1, array $array2): void
    {
        self::assertSame($expected, array_merge($array1, $array2));
    }

    public function provideArrayMergeWithTwoArrays(): Generator
    {
        yield 'merging two empty arrays results in an empty array' => [
            [], [], []
        ];

        yield 'merging an array with values with an empty array results in the same first array, but the numerical keys are reset' => [
            [0 => 'd', 'f' => 22, 1 => 82],
            [1 => 'd', 'f' => 22, 5 => 82],
            []
        ];

        yield 'merging two arrays containing only values results in an array containing all the values, using default numeric keys starting with 0' => [
            [0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5, 5 => 6],
            [1, 2, 3],
            [4, 5, 6,]
        ];

        yield 'merging two arrays with non conflicting numeric values results in an array containing all the values, ignoring the keys and using default numeric keys starting with 0' => [
            [0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5, 5 => 6],
            [1, 4 => 2, 3],
            [55 => 4, -5 => 5, 6]
        ];

        yield 'merging arrays with same numeric keys do NOT overwrite the value, the keys are ignored and default numeric keys starting with 0 are used' => [
            [0 => 1, 1 => 2, 2 => 3, 3 => 4],
            [1 => 1, 2],
            [1 => 3, 2 => 4]
        ];

        yield 'merging arrays without string keys result in an array containing all the values just joined together, even duplicate ones' => [
            [0, 2, 4, 0, 5, 4],
            [0, 2, 4],
            [0, 5, 4]
        ];

        yield 'non conflicting string keys, that can be converted into numeric keys, will be ignored and replaced with default numeric keys, starting at 0' => [
            ['c' => 1, 0 => 2, 1 => 3, 2 => 4],
            ['c' => 1, '2' => 2],
            ['-1' => 3, 4]
        ];

        yield 'merging arrays with duplicate string keys will overwrite their values, while values from duplicate numeric keys are appended with a default numeric key' => [
            ['a' => 1, 'b' => 5, 0 => 3, 1 => 4, 2 => 6],
            ['a' => 1, 'b' => 2, 3],
            [4, 'b' => 5, 1 => 6]
        ];

        yield 'merging arrays with duplicate string keys that can be cast to int behave like numeric keys, these are ignored and their values appended using a default numeric key' => [
            [0 => 1, 'c' => 2, 1 => 3, 2 => 4, 3 => 5, 4 => 6],
            ['1' => 1, 'c' => 2, '3' => 3],
            ['1' => 4, 2 => 5, '3' => 6]
        ];
    }

    /**
     * Tests merging multiple arrays using array_merge().
     * Calling array_merge() without any parameters (PHP 7.4+) will result in an empty array.
     * @dataProvider provideArrayMergeWithDynamicNumberOfArrays
     */
    public function testArrayMergeWithDynamicNumberOfArrays(array $expected, array ...$arrays): void
    {
        self::assertSame($expected, array_merge(...$arrays));
    }

    public function provideArrayMergeWithDynamicNumberOfArrays(): Generator
    {
        /**
         * array merge rules are applied, so numeric keys are thrown away
         */
        yield 'merging a single array' => [
            [0 => 'a', 'a' => 2, 1 => 1],
            [1 => 'a', 'a' => 2, '4' => 1]
        ];

        yield 'combined with array union operator' => [
            [0 => 1, 1 => 2, 2 => 3],
            [1, 2, 3] + [4, 5, 6],
        ];
    }
}
