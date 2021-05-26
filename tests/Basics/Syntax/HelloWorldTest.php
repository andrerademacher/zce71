<?php

declare(strict_types=1);

namespace Zce71\Basics\Syntax;

use PHPUnit\Framework\TestCase;

/**
 * The famous hello world, as unit test!
 */
class HelloWorldTest extends TestCase
{
    /**
     * echo outputs one or more expressions, with no additional spaces or newlines.
     * The main differences to print() are:
     *  - echo has no return value (the output goes to stdio), print returns always 1
     *  - echo accepts one or more expressions, print exactly 1 expression
     *
     * To be able to compare echo's output with 'hello world', the output has to be captured.
     * @return void
     */
    public function testWithEcho(): void
    {
        // enable output buffering
        ob_start();

        // output the message
        echo 'hello world';

        // store captured output in a variable
        $helloWorldFromOutput = ob_get_clean();

        self::assertSame('hello world', $helloWorldFromOutput);
    }

    /**
     * echo allows a native multiline approach.
     * @return void
     */
    public function testWithEchoMultiLine(): void
    {
        ob_start();
        echo
'hello world
in a multiline
statement!';
        $output = ob_get_clean();
        $expected = 'hello world' . PHP_EOL
            . 'in a multiline' . PHP_EOL
            . 'statement!';

        self::assertSame($expected, $output);
    }

    /**
     * print_r returns the value of a string, int or float directly, in case the second parameter "return" is true.
     * @return void
     */
    public function testWithPrintR(): void
    {
        self::assertSame('hello world', print_r('hello world', true));
    }

    /**
     * sprintf returns a string with the given values put into the format string.
     * @return void
     */
    public function testWithSprintf(): void
    {
        self::assertSame('hello world', sprintf('%s %s', 'hello', 'world'));
    }
}
