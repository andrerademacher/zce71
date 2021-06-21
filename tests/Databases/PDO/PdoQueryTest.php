<?php

declare(strict_types=1);

namespace Zce71\Databases\PDO;

use PDO;
use PHPUnit\Framework\TestCase;

/**
 * Tests a simple SELECT query.
 */
class PdoQueryTest extends TestCase
{
    /**
     * Tests accessing the local database with credentials from config file
     * @return void
     */
    public function testPdoQuerySelect(): void
    {
        $pdoConfig = require __DIR__ . '/db.config.local.php';
        $pdo = new PDO($pdoConfig['dsn'], $pdoConfig['username'], $pdoConfig['password'], $pdoConfig['options']);
        self::assertInstanceOf(PDO::class, $pdo);

        $select = <<<SQL
            SELECT * from city;
SQL;

        $result = $pdo->query($select);

        $rows = [];
        foreach ($result as $row) {
            $rows[] = $row;
        }

        // first row => 1, Dresden, 500000
        self::assertSame(1, (int)$rows[0][0]);
        self::assertSame('Dresden', $rows[0][1]);       // access by numeric column, 0 based
        self::assertSame('Dresden', $rows[0]['label']); // access by field name
        self::assertSame(500000, (int)$rows[0][2]);

        // self::assertSame(500000, $rows[0][3]); // forces "undefined offset" NOTICE

    }
}
