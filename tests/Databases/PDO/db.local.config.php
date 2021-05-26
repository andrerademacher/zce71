<?php

/**
 * Returns the configuration for the local database used by PDO.
 * The database can be created as follows:
 *
 * CREATE DATABASE zce71 CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI;
 * CREATE USER 'zce'@'localhost' IDENTIFIED WITH mysql_native_password BY 'passed';
 * GRANT CREATE, INSERT, SELECT, UPDATE, DROP, DELETE ON zce71.* TO 'zce'@'localhost';
 * FLUSH PRIVILEGES;
 */
return [
    'dsn' => 'mysql:host=127.0.0.1;dbname=zce71;charset=utf8mb4',
    'username' => 'zce',
    'password' => 'passed',
    'options' => [],
];

