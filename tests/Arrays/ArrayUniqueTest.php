<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests edge cases for array "uniqueness".
 * @see https://www.php.net/manual/de/function.array-unique.php
 */
class ArrayUniqueTest extends TestCase
{
    /**
     * Tests various ways of making an array's values "unique".
     * The kind of uniqueness is defined by $sortFlags:
     *
     * SORT_STRING (default): $input[0] is unique if (string)$input[0] is unique (string cast must not be identical)
     * SORT_REGULAR: $input[0] is unique if $input[0] is unique (value must not be identical)
     * SORT_NUMERIC: $input[0] is unique if $input[0] is unique (numeric value must not be identical)
     * SORT_LOCALE_STRING: $input[0] is unique if (string)$input[0] is unique based on current locale (string cast must not be identical)
     *
     * @dataProvider provideUnique
     */
    public function testUnique(array $expected, array $input, int $sortFlags = SORT_STRING): void
    {
        self::assertSame($expected, array_unique($input, $sortFlags));
    }

    /**
     * Provides data for testUnique.
     */
    public function provideUnique(): Generator
    {
        yield 'php.net example' => [
            ['a' => 'green', 0 => 'red', 1 => 'blue'],
            ['a' => 'green', 'red', 'b' => 'green', 'blue', 'red'],
        ];

        /**
         * Keys in result array are initially the same as in $input array.
         * Then mon-unique values (and their keys) are removed from the $input array.
         */
        yield 'numbers' => [
            ['b' => 1, 0 => 1.1, 2 => 2, 5 => 4],
            ['b' => 1, 1.1, '1', 2, 2, '2', 4, '4', 4.0],   // (string)4.0 === (string)4, (string)1 !== (string)1.1
            //keys  b, 0,    1,  2, 3,  4,  5,  6,   7
        ];
    }
}
