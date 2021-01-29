<?php

declare(strict_types=1);

namespace Basics\Syntax;

use PHPUnit\Framework\TestCase;

/**
 * The famous hello world, as unit test!
 */
class HelloWorldTest extends TestCase
{
    public function testHelloWorld(): void
    {
        self::assertSame('hello world', sprintf('%s %s', 'hello', 'world'));
    }
}
