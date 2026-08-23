<?php

use PhpMx\Cif;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Cif */
return new class {

    use TerminalTestTrait;

    function run()
    {
        $this->isTrue('on: começa e termina com -', fn() => str_starts_with(Cif::on('hello'), '-') && str_ends_with(Cif::on('hello'), '-'));
        $this->isTrue('on: idempotente', fn() => Cif::on(Cif::on('hello')) === Cif::on('hello'));

        $this->isTrue('check: cifra válida', fn() => Cif::check(Cif::on('hello')));
        $this->isFalse('check: string comum', fn() => Cif::check('nao-e-cif'));
        $this->isFalse('check: inteiro', fn() => Cif::check(42));

        $this->isEqual('off: string', fn() => Cif::off(Cif::on('hello')), 'hello');
        $this->isEqual('off: inteiro', fn() => Cif::off(Cif::on(42)), 42);
        $this->isEqual('off: array', fn() => Cif::off(Cif::on([1, 2, 3])), [1, 2, 3]);
        $this->isEqual('off: não-cifra retorna original', fn() => Cif::off('texto'), 'texto');

        $this->isTrue('compare: mesmo valor', fn() => Cif::compare('hello', 'hello'));
        $this->isFalse('compare: valores diferentes', fn() => Cif::compare('hello', 'world'));
        $this->isTrue('compare: cifra vs string', fn() => Cif::compare(Cif::on('hello'), 'hello'));
    }
};
