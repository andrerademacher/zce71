<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests the array_merge() method's edge cases.
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

    }

    public function testArrayMergeWithDynamicNumberOfArrays(array $expected, array ...$arrays): void
    {
        self::assertSame($expected, array_merge($arrays));
    }
}
