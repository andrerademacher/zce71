<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests the implode() method's edge cases.
 * @see https://www.php.net/manual/en/function.implode.php
 *
 * Empty values are not filtered.
 * This can be achieved using implode($separator, array_filter($inputArray)).
 */
class ImplodeTest extends TestCase
{
    /**
     * @dataProvider provideImplode
     */
    public function testImplode(string $expected, string $separator, array $input): void
    {
        self::assertSame($expected, implode($separator, $input));
    }

    public function provideImplode(): Generator
    {
        yield 'simple example' => [
            'hello, world',
            ', ',
            ['hello', 'world']
        ];

        yield 'null value at the beginning' => [
            ', hello, world',
            ', ',
            [null, 'hello', 'world']
        ];

        yield 'null value in the middle' => [
            'hello, , world',
            ', ',
            ['hello', null, 'world']
        ];

        yield 'null value at the end' => [
            'hello, world, ',
            ', ',
            ['hello', 'world', null]
        ];

        yield 'filtering out EMPTY values with array_filter()' => [
            'hello, 1, world',
            ', ',
            array_filter(['hello', null, 0, 1, false, '0', 'world'])
        ];
    }
}
