<?php
declare(strict_types=1);

namespace Zce71\Basics\LanguageConstructs;

use Generator;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\TestCase;

/**
 * Tests the list() language constuct's edge cases.
 *
 * Since PHP 7.1, list() respects array keys (numeric & string keys).
 */
class ListTest extends TestCase
{
    /**
     * Simple php.net example.
     */
    public function testSimpleDeconstruction(): void
    {
        $info = ['coffee', 'brown', 'caffeine'];
        list($drink, $color, $power) = $info;

        self::assertSame('coffee', $drink);
        self::assertSame('brown', $color);
        self::assertSame('caffeine', $power);
    }

    /**
     * list() respects array keys, but starts at 0 and triggers a NOTICE in case this key does not exist.
     */
    public function testTriggerNoticeByMissingZeroKey(): void
    {
        $this->expectException(Notice::class);
        $info = [1 => 1, 2 => 2, 3 => 3];
        list($a, $b, $c) = $info;
    }

    /**
     * list() respects array keys, but starts at 0 and iterates.
     * A NOTICE is triggered in case any expected key does not exist.
     * e.g. deconstucting an array to 5 variables expects numeric keys 0 to 4, otherwise NOTICES are triggered.
     */
    public function testTriggerNoticeByMissingExpectedNumericKey(): void
    {
        $this->expectException(Notice::class);
        $info = [0 => 0, 2 => 2, 3 => 3];
        list($a, $b, $c) = $info;
    }

    /**
     * list() respects array keys, but starts at 0 and iterates.
     * A NOTICE is triggered in case any expected key does not exist.
     * e.g. deconstucting an array to 5 variables expects numeric keys 0 to 4, otherwise NOTICES are triggered.
     */
    public function testTriggerNoticeByLessArrayValuesThanExpected(): void
    {
        Notice::$enabled = false;
        $info = [0 => 0, 1 => 1];
        list($a, $b, $c) = $info;

        self::assertSame($a, 0);
        self::assertSame($b, 1);
        self::assertNull($c);
    }

    /**
     * list() respects array keys.
     * @dataProvider provideIndexedDeconstruction
     */
    public function testIndexedDeconstruction($expectedA, $expectedB, $expectedC, array $input): void
    {
        list($a, $b, $c) = $input;

        self::assertSame($expectedA, $a);
        self::assertSame($expectedB, $b);
        self::assertSame($expectedC, $c);
    }

    public function provideIndexedDeconstruction(): Generator
    {
        /**
         * list() starts with array key 0
         */
        yield 'numeric ascending' => [
            0,
            1,
            2,
            [0 => 0, 1 => 1, 2 => 2, 3 => 3]
        ];

        /**
         * "order" in array does not matter, list() begins with key 0 and iterates
         */
        yield 'numeric descending' => [
            3,
            2,
            1,
            [3 => 0, 2 => 1, 1 => 2, 0 => 3]
        ];

        /**
         * list() starts with key 0, ignoring negative keys
         */
        yield 'array with negative keys' => [
            0,
            1,
            2,
            [-2 => -2, -1 => -1, 0 => 0, 1 => 1, 2 => 2, 3 => 3]
        ];

        /**
         * Non-numerical string keys are ignored completely.
         * Numeric string keys are interpreted as numeric keys.
         * list() starts with 0 and iterates.
         */
        yield 'array with string keys' => [
            '0',
            1,
            2,
            ['a' => 'a', 'A' => 'A', '0' => '0', 1 => 1, 2 => 2]
        ];
    }

    /**
     * With no keys given, list() starts at 0 and iterates.
     * With given keys, list accesses the input array at these keys in exactly that order.
     * @dataProvider provideListKeyOrder
     */
    public function testListKeyOrder($keyA, $expectedA, $keyB, $expectedB, $keyC, $expectedC, array $input): void
    {
        list($keyA => $valueA, $keyB => $valueB, $keyC => $valueC) = $input;

        self::assertSame($expectedA, $valueA);
        self::assertSame($expectedB, $valueB);
        self::assertSame($expectedC, $valueC);
    }

    public function provideListKeyOrder(): Generator
    {
        yield 'with string keys' => [
            'b', 'B',
            'a', 'A',
            'c', 'C',
            ['a' => 'A', 'b' => 'B', 'c' => 'C']
        ];

        yield 'with mixed keys' => [
            'fish', 'Fish',
            1,  1,
            'a', 'A',
            [1 => 1, 'a' => 'A', 'fish' => 'Fish']
        ];
    }
}
