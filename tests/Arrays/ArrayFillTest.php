<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\TestCase;

/**
 * Tests array creation with array_fill().
 * @see https://www.php.net/manual/en/function.array-fill.php
 *
 * array_fill() creates an array containing $count elements of $value with the numeric index beginning at $startIndex.
 * $count has to be greater or equal zero.
 */
class ArrayFillTest extends TestCase
{
    /**
     * tests array_fill()
     * @dataProvider provideFill
     */
    public function testFill(array $expected, int $startIndex, int $count, $value): void
    {
        self::assertSame($expected, array_fill($startIndex, $count, $value));
    }

    /**
     * Provides test cases.
     */
    public function provideFill(): Generator
    {
        yield 'php.net example' => [
            [
                5 => 'banana',
                6 => 'banana',
                7 => 'banana',
                8 => 'banana',
                9 => 'banana',
                10 => 'banana',
            ],
            5,
            6,
            'banana'
        ];

        yield 'negative startIndex' => [
            [
                -2 => 'fish',
                0 => 'fish',
                1 => 'fish'
            ],
            -2,
            3,
            'fish'
        ];

        yield 'count zero' => [
            [],
            22,
            0,
            'hello'
        ];
    }

    /**
     * When count is negative, array_fill() will trigger a WARNING.
     */
    public function testFillWithNegativeCountTriggersWarning(): void
    {
        $this->expectException(Warning::class);
        $resultFalse = array_fill(22, -2, 'hello');
    }

    /**
     * The return value after triggering a WARNING is false.
     */
    public function testFillWithNegativeCountReturnsFalse(): void
    {
        Warning::$enabled = false;
        self::assertFalse(array_fill(22, -2, 'hello'));
    }
}
