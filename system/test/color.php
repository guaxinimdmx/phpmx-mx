<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa os helpers colorRGB e colorHex */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // colorRGB: hex 6 chars
        $this->isEqual('colorRGB: #FF0000', fn() => colorRGB('#FF0000'), '255,0,0');
        $this->isEqual('colorRGB: sem #', fn() => colorRGB('00FF00'), '0,255,0');
        $this->isEqual('colorRGB: azul', fn() => colorRGB('0000FF'), '0,0,255');

        // colorRGB: hex 3 chars (expande)
        $this->isEqual('colorRGB: 3 chars', fn() => colorRGB('F00'), '255,0,0');

        // colorRGB: hex 1 char (aplica ao RGB)
        $this->isEqual('colorRGB: 1 char', fn() => colorRGB('F'), '255,255,255');

        // colorRGB: já está em RGB retorna igual
        $this->isEqual('colorRGB: já em RGB', fn() => colorRGB('255,0,0'), '255,0,0');

        // colorHex: RGB para hex
        $this->isEqual('colorHex: 255,0,0', fn() => colorHex('255,0,0'), 'ff0000');
        $this->isEqual('colorHex: 0,255,0', fn() => colorHex('0,255,0'), '00ff00');
        $this->isEqual('colorHex: 0,0,255', fn() => colorHex('0,0,255'), '0000ff');

        // colorHex: já em hex retorna limpo
        $this->isEqual('colorHex: remove #', fn() => colorHex('#ff0000'), 'ff0000');
        $this->isEqual('colorHex: já em hex', fn() => colorHex('ff0000'), 'ff0000');

        // round trip
        $this->isEqual('round trip: hex → rgb → hex', fn() => colorHex(colorRGB('1a2b3c')), '1a2b3c');
    }
};
