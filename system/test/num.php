<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa as funções helper num_* */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // num_round
        $this->isEqual('num_round: comum para cima', fn() => num_round(4.6), 5);
        $this->isEqual('num_round: comum para baixo', fn() => num_round(4.4), 4);
        $this->isEqual('num_round: floor', fn() => num_round(4.9, -1), 4);
        $this->isEqual('num_round: ceil', fn() => num_round(4.1, 1), 5);

        // num_interval
        $this->isEqual('num_interval: dentro do range', fn() => num_interval(5, 1, 10), 5);
        $this->isEqual('num_interval: abaixo do min', fn() => num_interval(0, 1, 10), 1);
        $this->isEqual('num_interval: acima do max', fn() => num_interval(15, 1, 10), 10);

        // num_positive
        $this->isEqual('num_positive: negativo', fn() => num_positive(-5), 5);
        $this->isEqual('num_positive: positivo', fn() => num_positive(5), 5);

        // num_negative
        $this->isEqual('num_negative: positivo', fn() => num_negative(5), -5);
        $this->isEqual('num_negative: negativo', fn() => num_negative(-5), -5);
    }
};
