<?php

declare(strict_types=1);

namespace Zce71\Strings;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests the reverse character in string search.
 * @see https://www.php.net/manual/en/function.strrchr.php
 *
 * Returns the part of the haystack beginning with the LAST occurrence of needle's first character until the end of haystack
 * or false, in case needle was not found in haystack.
 */
class StrRChrTest extends TestCase
{
    /**
     * Tests character in string search with strrchr().
     * @dataProvider provideString
     */
    public function testStringSearch($expected, string $hayStack, string $needle): void
    {
        self::assertSame($expected, strrchr($hayStack, $needle));
    }

    /**
     * Provides the test cases.
     */
    public function provideString(): Generator
    {
        yield 'abcdefg' => [
            'defg',
            'abcdefg',
            'd'
        ];

        yield 'uses only needle\'s first character (d)' => [
            'defg',
            'abcdefg',
            'dog'
        ];

        yield 'case sensitive' => [
            'The dog, and the cow.',
            'The fish. The dog, and the cow.',
            'The'
        ];

        yield 'false if not found' => [
            false,
            'abcde',
            'xyz'
        ];
    }
}
