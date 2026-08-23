<?php

use PhpMx\Snap;
use PhpMx\Trace;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Trace */
return new class {

    use TerminalTestTrait;

    function run()
    {
        Snap::capture('trace', Trace::class);

        // add sem closure
        $this->isNull('add: sem closure retorna null', fn() => Trace::add('test', 'hello'));

        // add com closure: executa e retorna resultado
        $this->isEqual('add: com closure retorna resultado', fn() => Trace::add('test', 'scope', fn() => 42), 42);

        // add com closure que lança exception: re-lança
        $this->isThrow('add: re-lança exception da closure', function () {
            Trace::add('test', 'scope', fn() => throw new \Exception('falha'));
        });

        // useTrace false: closure executada diretamente
        Trace::useTrace(false);
        $this->isEqual('useTrace false: closure executada', fn() => Trace::add('t', 'm', fn() => 'ok'), 'ok');
        Trace::useTrace(true);

        // changeScope: modifica o escopo aberto
        Trace::add('original', 'msg', function () {
            Trace::changeScope('modificado', 'nova_msg');
        });
        $found = array_filter(Trace::get()['trace'], fn($l) => $l[0] === 'modificado');
        $this->isTrue('changeScope: altera tipo do escopo', fn() => count($found) > 0);

        // get
        $this->isTrue('get: tem chave trace', fn() => isset(Trace::get()['trace']));
        $this->isTrue('get: tem chave count', fn() => isset(Trace::get()['count']));
        $this->isTrue('get: trace é array', fn() => is_array(Trace::get()['trace']));
        $this->isTrue('get: count é array', fn() => is_array(Trace::get()['count']));

        // getArray / getString
        $this->isTrue('getArray: retorna array', fn() => is_array(Trace::getArray()));
        $this->isTrue('getString: retorna string', fn() => is_string(Trace::getString()));
        $this->isTrue('getString: contém separadores', fn() => str_contains(Trace::getString(), '---'));

        Snap::restore('trace');
    }
};
