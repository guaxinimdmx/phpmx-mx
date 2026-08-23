<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa a função helper uuid */
return new class {

    use TerminalTestTrait;

    function run()
    {
        $this->isTrue('começa com _', fn() => str_starts_with(uuid(), '_'));
        $this->isTrue('tem 19 caracteres', fn() => strlen(uuid()) === 19);
        $this->isFalse('não é blank', fn() => is_blank(uuid()));
        $this->isTrue('duas chamadas são diferentes', fn() => uuid() !== uuid());
    }
};
