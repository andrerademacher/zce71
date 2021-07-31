<?php

declare(strict_types=1);

namespace Zce71\OOP\Modifiers;

use PHPUnit\Framework\TestCase;
use Zce71\OOP\Modifiers\Fixtures\MethodDefaultVisibility;

/**
 * Tests the behaviour of class methods.
 */
class ClassMethodTest extends TestCase
{
    /**
     * A class method's visibility is public by default in case no access modifier is given.
     */
    public function testMethodDefaultVisibility(): void
    {
        $object = new MethodDefaultVisibility();
        self::assertSame(2, $object->myMethod());
    }
}
