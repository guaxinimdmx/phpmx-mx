<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa a função helper remove_accents */
return new class {

    use TerminalTestTrait;

    function run()
    {
        $this->isEqual('acento agudo', fn() => remove_accents('café'), 'cafe');
        $this->isEqual('acento til', fn() => remove_accents('ação'), 'acao');
        $this->isEqual('cedilha', fn() => remove_accents('almoço'), 'almoco');
        $this->isEqual('acento grave', fn() => remove_accents('àquele'), 'aquele');
        $this->isEqual('sem acentos mantém', fn() => remove_accents('php'), 'php');
        $this->isEqual('misturado', fn() => remove_accents('Ação Rápida'), 'Acao Rapida');
    }
};
