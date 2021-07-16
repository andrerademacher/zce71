<?php

declare(strict_types=1);

namespace Zce71\Basics;

use PHPUnit\Framework\TestCase;

/**
 * Tests variable's behaviour with edge cases of prefix / postfix operators.
 */
class PrefixPostfixTest extends TestCase
{
    /**
     * Tests running multiple postfix operators on the same variable in one line.
     */
    public function testTriplePostfix(): void
    {
        $a = 2;
        $sum = $a++ + $a++ + $a++;
        self::assertSame(9, $sum);
    }

    /**
     * Tests running multiple prefix operators on the same variable in one line.
     */
    public function testTriplePrefix(): void
    {
        $a = 2;
        $sum = ++$a + ++$a + ++$a;
        self::assertSame(12, $sum);
    }

    /**
     * Tests running multiple prefix operators on the same variable in one line.
     */
    public function testMixedPrefixPostfix(): void
    {
        $a = 2;
        $sum = $a++ + ++$a + $a++ + ++$a;
        self::assertSame(16, $sum);
    }
}
