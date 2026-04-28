<?php

use PhpMx\Trait\TerminalMigrationTrait;

/** Reverte a última migration executada no banco de dados especificado */
return new class {

    use TerminalMigrationTrait;

    function __invoke(string $dbName = 'main')
    {
        self::down($dbName);
    }
};
