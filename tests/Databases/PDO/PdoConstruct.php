<?php

declare(strict_types=1);

namespace Zce71\Databases\PDO;

use PDO;
use PHPUnit\Framework\TestCase;

/**
 * @TODO Describe PdoConstruct
 *
 * @author          CHECK24 REDA <it.reise.direktanbindung@check24.de>
 * @copyright       2021 CHECK24 Vergleichsportal Reise GmbH
 */
class PdoConstruct extends TestCase
{
    /**
     * Tests accessing the local database with credentials from config file
     * @return void
     */
    public function testPdoConstruct(): void
    {
        $pdoConfig = require __DIR__ . '/db.local.config.php';
        $pdo = new PDO($pdoConfig['dsn'], $pdoConfig['username'], $pdoConfig['password'], $pdoConfig['options']);
        self::assertInstanceOf(PDO::class, $pdo);
    }
}
