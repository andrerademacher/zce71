<?php

declare(strict_types=1);

namespace Zce71\Strings;

use PHPUnit\Framework\TestCase;

/**
 * Tests basic string behaviour.
 *
 * @author          CHECK24 REDA <it.reise.direktanbindung@check24.de>
 * @copyright       2021 CHECK24 Vergleichsportal Reise GmbH
 */
class BasicTest extends TestCase
{
    public function testArrayLikeStringAccess(): void
    {
        $myString = 'HelloWorld!';
        self::assertSame('o', $myString[4]);
        self::assertSame('P', 'PHP'[0]);
    }
}
