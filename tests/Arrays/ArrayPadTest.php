<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests array padding with array_pad().
 * @see https://www.php.net/manual/en/function.array-pad.php
 *
 * array_pad() returns a copy of the array padded with the mixed value $value to the size $length.
 * If $length is positive, padding happens from the right, else from the left.
 * No padding takes place if the absolute value of $length is less or equal the current number of array items.
 *
 * @author          CHECK24 REDA <it.reise.direktanbindung@check24.de>
 * @copyright       2021 CHECK24 Vergleichsportal Reise GmbH
 */
class ArrayPadTest extends TestCase
{
    /**
     * tests array_pad()
     * @dataProvider providePad
     */
    public function testPad(array $expected, array $input, int $length, $value): void
    {
        self::assertSame($expected, array_pad($input, $length, $value));
    }

    /**
     * Provides test cases.
     */
    public function providePad(): Generator
    {
        yield 'php.net example' => [
            [12, 10, 9, 0, 0],
            [12, 10, 9],
            5,
            0
        ];

        yield 'negative length' => [
            ['hello', 12, 10, 9],
            [12, 10, 9],
            -4,
            'hello'
        ];

        yield 'length already fits' => [
            [1, 2, 3, 4, 5],
            [1, 2, 3, 4, 5],
            -3,
            12
        ];
    }
}
