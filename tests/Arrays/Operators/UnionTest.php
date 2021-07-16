<?php

declare(strict_types=1);

namespace Zce71\Arrays\Operators;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests the array union operator ("+").
 *
 */
class UnionTest extends TestCase
{
    /**
     * Tests edge cases with $array1 + $array2.
     * @dataProvider provideArrayUnion
     */
   public function testArrayUnion(array $expected, array $array1, array $array2): void
   {
       self::assertSame($expected, $array1 + $array2);
   }

    /**
     * Provides test data for array union.
     */
   public function provideArrayUnion(): Generator
   {
       /**
        * for matching keys, the value from the first array $array 1 is used, ignoring the value from the second one
        */
       yield 'php.net fruits example' => [
           [0 => 'apple', 1 => 'banana', 2 => 'cherry'],
           [0 => 'apple', 1 => 'banana', 2 => 'cherry'],
           [0 => 'pear', 1 => 'strawberry', 2 => 'cherry'],
       ];

       /**
        * for non matching keys, the result is $array2 appended to $array1 with same keys and values
        */
       yield 'non matching keys' => [
           [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
           [1 => 1, 2 => 2, 3 => 3],
           [4 => 4, 5 => 5, 6 => 6],
       ];
   }
}
