<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\TestCase;

/**
 * Tests the explode() method's edge cases.
 * @see https://www.php.net/manual/en/function.explode.php
 *
 * explode() returns false in case the seperator is empty.
 * if the separator is not found, the result will be an array containing the whole input string as the single value.
 */
class ExplodeTest extends TestCase
{
    /**
     * @dataProvider provideExplode
     */
    public function testExplode($expected, string $separator, string $input): void
    {
        self::assertSame($expected, explode($separator, $input));
    }

    public function provideExplode(): Generator
    {
        yield 'simple example' => [
            ['hello', ' world'],
            ',',
            'hello, world'
        ];
    }

    public function testEmptySeparatorTriggersWarningAndReturnsFalse(): void
    {
        Warning::$enabled=false;
        self::assertFalse(explode('', 'hello world'));
    }

    public function testEmptySeparatorTriggersWarning(): void
    {
        $this->expectException(Warning::class);
        $result = explode('', 'hello world');
    }
}
