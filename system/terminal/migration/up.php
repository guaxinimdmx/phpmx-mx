<?php

use PhpMx\Trait\TerminalMigrationTrait;

/** Executa a próxima migration pendente no banco de dados especificado */
return new class {

    use TerminalMigrationTrait;

    function __invoke(string $dbName = 'main')
    {
        self::up($dbName);
    }
};
