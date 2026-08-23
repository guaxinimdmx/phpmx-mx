<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa o helper phpex */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // extensão existente retorna true
        $this->isTrue('phpex: mbstring carregado', fn() => phpex('mbstring'));
        $this->isTrue('phpex: json carregado', fn() => phpex('json'));

        // extensão inexistente sem throw retorna false
        $this->isFalse('phpex: inexistente retorna false', fn() => phpex('extensao_xyz_inexistente', false));

        // extensão inexistente com throw lança exception
        $this->isThrow('phpex: inexistente lança exception', fn() => phpex('extensao_xyz_inexistente'));
    }
};
