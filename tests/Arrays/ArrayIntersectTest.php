<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests creating an array intersection with array_intersect() comparing the values.
 * @see https://www.php.net/manual/en/function.array-intersect.php
 *
 * array_intersect() returns an array containing all the input array's key/value pairs that are present
 * in at least one of the other arrays their value's string representation both arrays are equal).
 */
class ArrayIntersectTest extends TestCase
{
    /**
     * tests array_intersect()
     * @dataProvider provideIntersect
     */
    public function testIntersect(array $expected, array $input, array ...$other): void
    {
        self::assertSame($expected, array_intersect($input, ...$other));
    }

    /**
     * Provides test cases.
     */
    public function provideIntersect(): Generator
    {
        yield 'php.net example' => [
            ['a' => 'green', 0 => 'red'],
            ['a' => 'green', 'red', 'blue'],
            ['b' => 'green', 'yellow', 'red']
        ];
    }
}
