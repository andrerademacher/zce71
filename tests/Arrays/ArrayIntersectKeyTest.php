<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests creating an array intersection with array_intersect_key() comparing the keys.
 * @see https://www.php.net/manual/en/function.array-intersect-key.php
 *
 * array_intersect_key() returns an array containing all the input array's key/value pairs that are present
 * in at least one of the other arrays (their key's string representation both arrays are equal).
 */
class ArrayIntersectKeyTest extends TestCase
{
    /**
     * tests array_intersect_key()
     * @dataProvider provideIntersectKey
     */
    public function testIntersectKey(array $expected, array $input, array ...$other): void
    {
        self::assertSame($expected, array_intersect_key($input, ...$other));
    }

    /**
     * Provides test cases.
     */
    public function provideIntersectKey(): Generator
    {
        yield 'php.net example' => [
            ['blue' => 1, 'green' => 3],
            ['blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4],
            ['green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan' => 8]
        ];
    }
}
