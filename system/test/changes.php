<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa os helpers applyChanges e getChanges */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // applyChanges: altera valor existente
        $arr = ['a' => 1, 'b' => 2];
        applyChanges($arr, ['a' => 10]);
        $this->isEqual('applyChanges: altera valor', fn() => $arr['a'], 10);

        // applyChanges: null remove a chave
        $arr = ['a' => 1, 'b' => 2];
        applyChanges($arr, ['a' => null]);
        $this->isFalse('applyChanges: null remove chave', fn() => isset($arr['a']));

        // applyChanges: adiciona chave nova
        $arr = ['a' => 1];
        applyChanges($arr, ['b' => 2]);
        $this->isEqual('applyChanges: adiciona chave nova', fn() => $arr['b'], 2);

        // applyChanges: chave null não existente é ignorada
        $arr = ['a' => 1];
        applyChanges($arr, ['b' => null]);
        $this->isFalse('applyChanges: null em chave inexistente ignorado', fn() => isset($arr['b']));

        // applyChanges: recursivo em arrays aninhados
        $arr = ['x' => ['y' => 1, 'z' => 2]];
        applyChanges($arr, ['x' => ['y' => 99]]);
        $this->isEqual('applyChanges: recursivo altera nested', fn() => $arr['x']['y'], 99);
        $this->isEqual('applyChanges: recursivo preserva outras', fn() => $arr['x']['z'], 2);

        // getChanges: valor alterado aparece
        $changes = getChanges(['a' => 2], ['a' => 1]);
        $this->isEqual('getChanges: valor alterado', fn() => $changes['a'], 2);

        // getChanges: valor igual não aparece
        $changes = getChanges(['a' => 1], ['a' => 1]);
        $this->isFalse('getChanges: valor igual não aparece', fn() => isset($changes['a']));

        // getChanges: chave removida vira null
        $changes = getChanges([], ['a' => 1]);
        $this->isNull('getChanges: chave removida vira null', fn() => $changes['a']);

        // getChanges: chave adicionada aparece
        $changes = getChanges(['b' => 5], []);
        $this->isEqual('getChanges: chave adicionada', fn() => $changes['b'], 5);

        // getChanges: recursivo em arrays aninhados
        $changes = getChanges(['x' => ['y' => 2, 'z' => 1]], ['x' => ['y' => 1, 'z' => 1]]);
        $this->isEqual('getChanges: recursivo detecta mudança nested', fn() => $changes['x']['y'], 2);
        $this->isFalse('getChanges: recursivo ignora igual nested', fn() => isset($changes['x']['z']));
    }
};
