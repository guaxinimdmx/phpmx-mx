<?php

use PhpMx\Datalayer;
use PhpMx\Datalayer\Migration;
use PhpMx\Datalayer\Query;
use PhpMx\Trait\TerminalTestTrait;

/** Testa uma migration real (Migration -> Scheme -> Connection) aplicada em SQLite em memória */
return new class {

    use TerminalTestTrait;

    const DB = 'testMigration';

    function run()
    {
        Datalayer::register(self::DB, ['type' => 'sqlite', 'file' => ':memory:']);

        try {
            $migration = new class extends Migration {
                function up()
                {
                    $this->table('pessoa', 'Pessoas cadastradas')->fields([
                        $this->fVarchar('nome', 'Nome completo')->null(false),
                        $this->fEmail('email', 'E-mail de contato')->default(null),
                    ]);
                }

                function down()
                {
                    $this->table('pessoa')->drop();
                }
            };

            $tableExists = fn() => Datalayer::get(self::DB)->executeQuery(
                "SELECT `name` FROM `sqlite_master` WHERE `type`='table' AND `name`='pessoa'"
            );
            $columns = fn() => array_column(Datalayer::get(self::DB)->executeQuery('PRAGMA table_info(`pessoa`)'), 'name');

            // === up: aplica a migration e cria a tabela via Scheme (sem SQL manual) ===
            $migration->execute(self::DB, true);

            $this->isCount('up: tabela pessoa criada pela migration', $tableExists, 1);
            $this->isContains('up: campo nome criado', $columns, 'nome');
            $this->isContains('up: campo email criado', $columns, 'email');
            $this->isContains('up: campo de controle _created criado', $columns, '_created');
            $this->isContains('up: campo de controle _updated criado', $columns, '_updated');
            $this->isContains('up: campo de controle _deleted criado', $columns, '_deleted');

            // === CRUD sobre a tabela criada pela migration ===
            $id = Query::insert('pessoa')->values(['nome' => 'Ricardo', 'email' => 'ricardo@example.com'])->run(self::DB);
            $row = Query::select('pessoa')->where('id', $id)->limit(1)->run(self::DB)[0];

            $this->isEqual('crud: nome persistido', fn() => $row['nome'], 'Ricardo');
            $this->isEqual('crud: email persistido', fn() => $row['email'], 'ricardo@example.com');
            $this->isFalse('crud: _created preenchido pelo default do banco', fn() => empty($row['_created']));

            // nome é NOT NULL na migration -> insert sem valor deve lançar
            $this->isThrow('crud: nome obrigatório (NOT NULL) lança sem valor', fn() => Query::insert('pessoa')->values(['email' => 'x@x.com'])->run(self::DB));

            // === down: reverte a migration e remove a tabela via Scheme ===
            $migration->execute(self::DB, false);

            $this->isCount('down: tabela pessoa removida pela migration', $tableExists, 0);
        } finally {
            Datalayer::unregister(self::DB);
        }
    }
};
