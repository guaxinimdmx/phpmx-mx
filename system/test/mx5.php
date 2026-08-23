<?php

use PhpMx\Mx5;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Mx5 */
return new class {

    use TerminalTestTrait;

    function run()
    {
        $hash = Mx5::on('phpmx');

        $this->isTrue('on: 34 caracteres', fn() => strlen(Mx5::on('phpmx')) === 34);
        $this->isTrue('on: começa com m', fn() => str_starts_with(Mx5::on('phpmx'), 'm'));
        $this->isTrue('on: termina com x', fn() => str_ends_with(Mx5::on('phpmx'), 'x'));
        $this->isTrue('on: idempotente', fn() => Mx5::on(Mx5::on('phpmx')) === Mx5::on('phpmx'));

        $this->isTrue('check: válido', fn() => Mx5::check(Mx5::on('phpmx')));
        $this->isFalse('check: md5 puro', fn() => Mx5::check(md5('phpmx')));
        $this->isFalse('check: string aleatória', fn() => Mx5::check('nao-e-mx5'));

        $this->isEqual('off: retorna md5', fn() => Mx5::off(Mx5::on('phpmx')), md5('phpmx'));

        $this->isTrue('compare: mesmo valor', fn() => Mx5::compare('phpmx', 'phpmx'));
        $this->isFalse('compare: valores diferentes', fn() => Mx5::compare('phpmx', 'outro'));
        $this->isTrue('compare: hash vs string', fn() => Mx5::compare(Mx5::on('phpmx'), 'phpmx'));
    }
};
