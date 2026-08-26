<?php

use PhpMx\Datalayer;
use PhpMx\Datalayer\Query;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a conexão real com banco SQLite em memória (sem tocar disco) */
return new class {

    use TerminalTestTrait;

    const DB = 'testMemory';

    function run()
    {
        Datalayer::register(self::DB, ['type' => 'sqlite', 'file' => ':memory:']);

        try {
            $db = Datalayer::get(self::DB);

            // === pragmas padrão ===
            $this->isEqual(
                'pragma: busy_timeout padrão aplicado',
                fn() => $db->executeQuery('PRAGMA busy_timeout')[0]['timeout'],
                5000
            );

            // === schema ===
            $this->isNotThrow(
                'CREATE TABLE roda sem erro',
                fn() => $db->executeQuery('CREATE TABLE `pessoa` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `nome` TEXT NOT NULL)')
            );

            // === insert ===
            $id = Query::insert('pessoa')->values(['nome' => 'Ricardo'])->run(self::DB);
            $this->isEqual('insert: retorna id inserido', fn() => (int) $id, 1);

            Query::insert('pessoa')->values(['nome' => 'Maria'])->run(self::DB);

            // === select ===
            $this->isCount('select: lista todos os registros', fn() => Query::select('pessoa')->run(self::DB), 2);

            $row = Query::select('pessoa')->where('id', $id)->limit(1)->run(self::DB)[0];
            $this->isEqual('select: campo persistido corretamente', fn() => $row['nome'], 'Ricardo');

            // === update ===
            Query::update('pessoa')->values(['nome' => 'Ricardo Jr'])->where('id', $id)->run(self::DB);
            $updated = Query::select('pessoa')->where('id', $id)->limit(1)->run(self::DB)[0];
            $this->isEqual('update: altera valor persistido', fn() => $updated['nome'], 'Ricardo Jr');

            // === delete ===
            Query::delete('pessoa')->where('id', $id)->run(self::DB);
            $this->isCount('delete: remove o registro', fn() => Query::select('pessoa')->run(self::DB), 1);
        } finally {
            Datalayer::unregister(self::DB);
        }
    }
};
