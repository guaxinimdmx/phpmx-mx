<?php

use PhpMx\Datalayer\Query;
use PhpMx\Trait\TerminalTestTrait;

/** Testa os query builders do Datalayer (sem banco de dados) */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // === Query factory ===
        $this->isTrue('factory: select', fn() => Query::select('t') instanceof \PhpMx\Datalayer\Query\Select);
        $this->isTrue('factory: insert', fn() => Query::insert('t') instanceof \PhpMx\Datalayer\Query\Insert);
        $this->isTrue('factory: update', fn() => Query::update('t') instanceof \PhpMx\Datalayer\Query\Update);
        $this->isTrue('factory: delete', fn() => Query::delete('t') instanceof \PhpMx\Datalayer\Query\Delete);

        // === mountTable ===
        $this->isTrue('table: simples', fn() => str_contains(Query::select('users')->query()[0], '`users`'));
        $this->isTrue('table: schema.table', fn() => str_contains(Query::select('db.users')->query()[0], '`db`.`users`'));
        $this->isTrue('table: array com alias', fn() => str_contains(Query::select(['users' => 'u'])->query()[0], '`users` as `u`'));

        // sem tabela → lança
        $this->isThrow('table: ausente lança', fn() => Query::select()->query());

        // === SELECT ===

        // fields padrão: tabela.*
        $this->isTrue('select: fields padrão tabela.*', fn() => str_contains(Query::select('users')->query()[0], '`users`.*'));

        // fields específicos
        [$sql] = Query::select('users')->fields('id', 'name')->query();
        $this->isTrue('select: fields id', fn() => str_contains($sql, '`id`'));
        $this->isTrue('select: fields name', fn() => str_contains($sql, '`name`'));

        // fields com alias
        [$sql] = Query::select('users')->fields(['user_name' => 'nome'])->query();
        $this->isTrue('select: fields com alias', fn() => str_contains($sql, '`user_name` as `nome`'));

        // distinct
        $this->isTrue('select: distinct', fn() => str_contains(Query::select('users')->fields('id')->distinct()->query()[0], 'DISTINCT'));

        // where com valor: campo shorthand
        [$sql, $binds] = Query::select('users')->where('id', 5)->query();
        $this->isTrue('select: where campo', fn() => str_contains($sql, 'WHERE'));
        $this->isTrue('select: where bind', fn() => isset($binds['where_0']) && $binds['where_0'] === 5);

        // where raw (sem valor)
        [$sql] = Query::select('users')->where('active = 1')->query();
        $this->isTrue('select: where raw', fn() => str_contains($sql, 'WHERE'));

        // whereNull
        [$sql] = Query::select('users')->whereNull('deleted')->query();
        $this->isTrue('select: whereNull IS NULL', fn() => str_contains($sql, 'is null'));

        // whereNull false → IS NOT NULL
        [$sql] = Query::select('users')->whereNull('deleted', false)->query();
        $this->isTrue('select: whereNull IS NOT NULL', fn() => str_contains($sql, 'is not null'));

        // whereIn
        [$sql] = Query::select('users')->whereIn('id', [1, 2, 3])->query();
        $this->isTrue('select: whereIn contém ids', fn() => str_contains($sql, 'in (1,2,3)'));

        // order ASC
        [$sql] = Query::select('users')->order('name')->query();
        $this->isTrue('select: order ASC', fn() => str_contains($sql, 'ORDER BY `name` ASC'));

        // order DESC
        [$sql] = Query::select('users')->order('name', false)->query();
        $this->isTrue('select: order DESC', fn() => str_contains($sql, 'ORDER BY `name` DESC'));

        // limit
        [$sql] = Query::select('users')->limit(10)->query();
        $this->isTrue('select: limit', fn() => str_contains($sql, 'LIMIT 10'));

        // page
        [$sql] = Query::select('users')->page(2, 10)->query();
        $this->isTrue('select: page offset', fn() => str_contains($sql, 'LIMIT 10 OFFSET 10'));

        // group
        [$sql] = Query::select('users')->group('status')->query();
        $this->isTrue('select: group by', fn() => str_contains($sql, 'GROUP BY status'));

        // left join
        [$sql] = Query::select('users')->leftJoin('orders', 'users.id = orders.user_id')->query();
        $this->isTrue('select: LEFT JOIN', fn() => str_contains($sql, 'LEFT JOIN'));

        // right join
        [$sql] = Query::select('users')->rightJoin('orders', 'users.id = orders.id')->query();
        $this->isTrue('select: RIGHT JOIN', fn() => str_contains($sql, 'RIGHT JOIN'));

        // multiple where conditions
        [$sql, $binds] = Query::select('users')->where('status', 'active')->where('age', 18)->query();
        $this->isTrue('select: múltiplos where', fn() => isset($binds['where_0']) && isset($binds['where_1']));

        // === INSERT ===

        [$sql, $binds] = Query::insert('users')->values(['name' => 'Ricardo', 'age' => 30])->query();
        $this->isTrue('insert: contém INSERT INTO', fn() => str_contains($sql, 'INSERT INTO'));
        $this->isTrue('insert: backtick em coluna', fn() => str_contains($sql, '`name`'));
        $this->isTrue('insert: bind name', fn() => isset($binds['name_0']) && $binds['name_0'] === 'Ricardo');
        $this->isTrue('insert: bind age', fn() => isset($binds['age_0']) && $binds['age_0'] === 30);

        // null vira NULL literal no SQL
        [$sql, $binds] = Query::insert('users')->values(['name' => 'X', 'deleted' => null])->query();
        $this->isTrue('insert: null vira NULL', fn() => str_contains($sql, 'NULL'));
        $this->isFalse('insert: null não vai para binds', fn() => isset($binds['deleted_0']));

        // múltiplos registros
        [$sql] = Query::insert('users')->values(['name' => 'A'], ['name' => 'B'])->query();
        $this->isTrue('insert: múltiplos registros', fn() => str_contains($sql, ':name_0') && str_contains($sql, ':name_1'));

        // array em table → lança
        $this->isThrow('insert: table array lança', fn() => Query::insert(['users' => 'u'])->values(['x' => 1])->query());

        // === UPDATE ===

        [$sql, $binds] = Query::update('users')->values(['name' => 'novo'])->where('id', 5)->query();
        $this->isTrue('update: contém UPDATE', fn() => str_contains($sql, 'UPDATE'));
        $this->isTrue('update: SET com bind', fn() => str_contains($sql, ':value_name'));
        $this->isTrue('update: WHERE', fn() => str_contains($sql, 'WHERE'));
        $this->isTrue('update: bind value', fn() => isset($binds['value_name']) && $binds['value_name'] === 'novo');
        $this->isTrue('update: bind where', fn() => isset($binds['where_0']) && $binds['where_0'] === 5);

        // null no SET vira NULL literal
        [$sql] = Query::update('users')->values(['deleted' => null])->where('id', 1)->query();
        $this->isTrue('update: null vira NULL no SET', fn() => str_contains($sql, '`deleted` = NULL'));

        // sem where → lança
        $this->isThrow('update: sem where lança', fn() => Query::update('users')->values(['x' => 1])->query());

        // sem values → lança
        $this->isThrow('update: sem values lança', fn() => Query::update('users')->where('id', 1)->query());

        // === DELETE ===

        [$sql, $binds] = Query::delete('users')->where('id', 5)->query();
        $this->isTrue('delete: contém DELETE FROM', fn() => str_contains($sql, 'DELETE FROM'));
        $this->isTrue('delete: WHERE', fn() => str_contains($sql, 'WHERE'));
        $this->isTrue('delete: bind', fn() => isset($binds['where_0']) && $binds['where_0'] === 5);

        // order
        [$sql] = Query::delete('users')->where('id', 1)->order('created', false)->query();
        $this->isTrue('delete: ORDER BY DESC', fn() => str_contains($sql, 'ORDER BY `created` DESC'));

        // sem where → lança
        $this->isThrow('delete: sem where lança', fn() => Query::delete('users')->query());
    }
};
