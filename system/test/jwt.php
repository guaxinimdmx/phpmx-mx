<?php

use PhpMx\Jwt;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Jwt */
return new class {

    use TerminalTestTrait;

    const KEY = 'chave-secreta-teste';

    function run()
    {
        $token = Jwt::on('hello', self::KEY);

        // estrutura
        $this->isTrue('on: retorna string', fn() => is_string($token));
        $this->isTrue('on: três partes', fn() => count(explode('.', $token)) === 3);

        // check
        $this->isTrue('check: token válido', fn() => Jwt::check($token, self::KEY));
        $this->isFalse('check: chave errada', fn() => Jwt::check($token, 'chave-errada'));
        $this->isFalse('check: não string', fn() => Jwt::check(42, self::KEY));
        $this->isFalse('check: string aleatória', fn() => Jwt::check('nao.e.jwt', self::KEY));

        // off
        $this->isEqual('off: payload string', fn() => Jwt::off($token, self::KEY), 'hello');
        $this->isFalse('off: chave errada', fn() => Jwt::off($token, 'chave-errada'));
        $this->isFalse('off: token inválido', fn() => Jwt::off('invalido', self::KEY));

        // payload array
        $payload = ['user' => 1, 'role' => 'admin'];
        $this->isEqual('on/off: array', fn() => Jwt::off(Jwt::on($payload, self::KEY), self::KEY), $payload);

        // determinismo
        $this->isTrue('on: mesmo payload mesma chave gera token igual', fn() => Jwt::on('a', self::KEY) === Jwt::on('a', self::KEY));
    }
};
