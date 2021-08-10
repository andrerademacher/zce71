<?php

declare(strict_types=1);

namespace Zce71\Basics\Constants;

use PHPUnit\Framework\TestCase;

/**
 * @TODO Describe ConstantTest
 *
 * @author          CHECK24 REDA <it.reise.direktanbindung@check24.de>
 * @copyright       2021 CHECK24 Vergleichsportal Reise GmbH
 */
class ConstantTest extends TestCase
{
    const CONST_EMPTY = '';

    /**
     * Class constant can be accessed with functions and language construct empty().
     */
    public function testConstantWithEmpty(): void
    {
        self::assertTrue(empty(self::CONST_EMPTY));
    }

    /**
     * Previously runtime defined constant can be accessed with functions and language construct empty().
     */
    public function testDefineWithEmpty(): void
    {
        define('DEFINE_EMPTY', '');
        self::assertTrue(empty(DEFINE_EMPTY));
    }
}
