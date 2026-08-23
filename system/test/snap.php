<?php

use PhpMx\Snap;
use PhpMx\Request;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Snap */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // captura estado inicial
        Snap::capture('snap_s1', Request::class);

        // modifica estado
        Request::set_query('snap_key', 'valor_original');
        $this->isEqual('após set, tem valor', fn() => Request::query('snap_key'), 'valor_original');

        // restaura para estado inicial
        Snap::restore('snap_s1');
        $this->isNull('restore: query limpa', fn() => Request::query('snap_key'));

        // captura estado modificado
        Request::set_query('snap_key', 'valor_a');
        Snap::capture('snap_s2', Request::class);

        // modifica novamente
        Request::set_query('snap_key', 'valor_b');
        $this->isEqual('após segundo set, tem valor_b', fn() => Request::query('snap_key'), 'valor_b');

        // restaura para estado modificado capturado
        Snap::restore('snap_s2');
        $this->isEqual('restore: volta para valor_a', fn() => Request::query('snap_key'), 'valor_a');

        // limpeza
        Snap::restore('snap_s1');
    }
};
