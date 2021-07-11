<?php

declare(strict_types=1);

namespace Zce71\Strings;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests string in string search with strstr().
 * @see https://www.php.net/manual/en/function.strstr.php
 *
 * strstr() returns the content from haystack beginning with (containing) the first occurrence of needle until the end of haystack.
 * Returns false in case needle was not found.
 * In case the optional parameter $beforeNeedle is set to true, the part of the haystack before needle is returned excluding the needle.
 */
class StrStrTest extends TestCase
{
    /**
     * Tests string in string search with strstr().
     * @dataProvider provideString
     */
    public function testStringSearch($expected, string $hayStack, string $needle, bool $beforeNeedle = false): void
    {
        self::assertSame($expected, strstr($hayStack, $needle, $beforeNeedle));
    }

    /**
     * Provides the test cases.
     */
    public function provideString(): Generator
    {
        yield 'simple example' => [
            'needle',
            'haystack with needle',
            'needle'
        ];

        yield 'returns needle to end of haystack' => [
            'needle in the haystack',
            'the needle in the haystack',
            'needle'
        ];

        yield 'case sensitive' => [
            'red RED',
            'Red red RED',
            'red'
        ];

        yield 'not found' => [
            false,
            'red green blue',
            'black'
        ];

        yield 'php.net example with $before_needle set' => [
            'name',
            'name@example.com',
            '@',
            true
        ];
    }
}
