<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa as funções helper is_* */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // is_blank
        $this->isTrue('is_blank: null', fn() => is_blank(null));
        $this->isTrue('is_blank: string vazia', fn() => is_blank(''));
        $this->isTrue('is_blank: só espaços', fn() => is_blank('   '));
        $this->isFalse('is_blank: zero', fn() => is_blank(0));
        $this->isFalse('is_blank: false', fn() => is_blank(false));
        $this->isFalse('is_blank: string com conteúdo', fn() => is_blank('a'));

        // is_class
        $this->isTrue('is_class: classe exata', fn() => is_class(InvalidArgumentException::class, InvalidArgumentException::class));
        $this->isTrue('is_class: classe pai', fn() => is_class(OverflowException::class, RuntimeException::class));
        $this->isFalse('is_class: classe errada', fn() => is_class(InvalidArgumentException::class, RuntimeException::class));
        $this->isFalse('is_class: não é classe', fn() => is_class('nao_existe', Exception::class));

        // is_extend
        $this->isTrue('is_extend: estende pai', fn() => is_extend(OverflowException::class, RuntimeException::class));
        $this->isFalse('is_extend: mesma classe', fn() => is_extend(RuntimeException::class, RuntimeException::class));
        $this->isFalse('is_extend: não estende', fn() => is_extend(InvalidArgumentException::class, RuntimeException::class));

        // is_closure
        $this->isTrue('is_closure: Closure', fn() => is_closure(fn() => true));
        $this->isFalse('is_closure: string', fn() => is_closure('strlen'));
        $this->isFalse('is_closure: null', fn() => is_closure(null));

        // is_json
        $this->isTrue('is_json: objeto válido', fn() => is_json('{"a":1}'));
        $this->isTrue('is_json: array válido', fn() => is_json('[1,2,3]'));
        $this->isFalse('is_json: string inválida', fn() => is_json('not json'));
        $this->isFalse('is_json: não string', fn() => is_json(42));

        // is_md5
        $this->isTrue('is_md5: hash válido', fn() => is_md5(md5('teste')));
        $this->isFalse('is_md5: string curta', fn() => is_md5('abc123'));
        $this->isFalse('is_md5: caractere inválido', fn() => is_md5(str_repeat('g', 32)));

        // is_stringable
        $this->isTrue('is_stringable: string', fn() => is_stringable('texto'));
        $this->isTrue('is_stringable: inteiro', fn() => is_stringable(42));
        $this->isTrue('is_stringable: float', fn() => is_stringable(3.14));
        $this->isFalse('is_stringable: array', fn() => is_stringable([]));
        $this->isFalse('is_stringable: null', fn() => is_stringable(null));

        // is_httpStatus
        $this->isTrue('is_httpStatus: 200', fn() => is_httpStatus(200));
        $this->isTrue('is_httpStatus: 404', fn() => is_httpStatus(404));
        $this->isFalse('is_httpStatus: 99', fn() => is_httpStatus(99));
        $this->isFalse('is_httpStatus: 600', fn() => is_httpStatus(600));

        // is_httpStatusError
        $this->isTrue('is_httpStatusError: 400', fn() => is_httpStatusError(400));
        $this->isTrue('is_httpStatusError: 500', fn() => is_httpStatusError(500));
        $this->isFalse('is_httpStatusError: 200', fn() => is_httpStatusError(200));
        $this->isFalse('is_httpStatusError: 301', fn() => is_httpStatusError(301));

        // is_base64
        $this->isTrue('is_base64: válida', fn() => is_base64(base64_encode('phpmx')));
        $this->isFalse('is_base64: inválida', fn() => is_base64('não é base64!'));
        $this->isFalse('is_base64: vazia', fn() => is_base64(''));
    }
};
