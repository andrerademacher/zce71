<?php

declare(strict_types=1);

namespace Zce71\Databases\PDO;

use PDO;
use PHPUnit\Framework\TestCase;

/**
 * Tests creating a PDO with a valid dsn.
 */
class PdoConstructTest extends TestCase
{
    /**
     * Tests accessing the local database with credentials from config file
     * @return void
     */
    public function testPdoConstruct(): void
    {
        $pdoConfig = require __DIR__ . '/db.config.local.php';
        $pdo = new PDO($pdoConfig['dsn'], $pdoConfig['username'], $pdoConfig['password'], $pdoConfig['options']);
        self::assertInstanceOf(PDO::class, $pdo);
    }
}
