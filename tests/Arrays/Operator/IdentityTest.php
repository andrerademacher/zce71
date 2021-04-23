<?php

declare(strict_types=1);

namespace Zce71\Arrays\Operator;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests the identity ("===") operator's behaviour on arrays.
 */
class IdentityTest extends TestCase
{
    /**
     * Tests array1 === array2. Just 2 arrays.
     * @dataProvider provideIdentityWithTwoArrays
     */
    public function testIdentityWithTwoArrays(bool $expected, array $array1, array $array2): void
    {
        self::assertSame($expected, $array1 === $array2);
    }

    public function provideIdentityWithTwoArrays(): Generator
    {
        yield 'empty arrays are identical' => [
            true, [], []
        ];

        yield 'arrays with same key-value pairs, but with different order, are not identical' => [
            false, [0 => 'a', 1 => 'b', 2 => 'c',], [1 => 'b', 2 => 'c', 0 => 'a',]
        ];
    }
}
