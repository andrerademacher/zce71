<?php

declare(strict_types=1);

namespace Zce71\Arrays;

use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests array splitting with array_chunk().
 * The $input array is split into chunks (array) with size $chunkSize. The last chunk can have less than $chunkSize items.
 * In case $preserveKeys is false (default), array_chunk() will reindex every chunk array numerically.
 * Otherwise, the keys will be kept.
 * @see https://www.php.net/manual/en/function.array-chunk.php
 */
class ArrayChunkTest extends TestCase
{
    /**
     * Test array_chunk().
     * @dataProvider provideChunk
     */
    public function testChunk(array $expected, array $input, int $chunkSize, bool $preserveKeys = false): void
    {
        self::assertSame($expected, array_chunk($input, $chunkSize, $preserveKeys));
    }

    /**
     */
    public function provideChunk(): Generator
    {
        yield 'php.net example' => [
            [[0 => 'a', 1 => 'b'], [0 => 'c', 1 => 'd'], [0 => 'e']],
            ['a', 'b', 'c', 'd', 'e'],
            2
        ];
    }
}
