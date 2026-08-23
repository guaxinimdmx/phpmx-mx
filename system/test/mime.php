<?php

use PhpMx\Mime;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Mime */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // getMimeEx
        $this->isEqual('getMimeEx: jpg', fn() => Mime::getMimeEx('jpg'), 'image/jpeg');
        $this->isEqual('getMimeEx: maiúscula normaliza', fn() => Mime::getMimeEx('JPG'), 'image/jpeg');
        $this->isNull('getMimeEx: desconhecida', fn() => Mime::getMimeEx('xyz'));

        // getExMime
        $this->isEqual('getExMime: image/jpeg', fn() => Mime::getExMime('image/jpeg'), 'jpg');
        $this->isNull('getExMime: desconhecido', fn() => Mime::getExMime('application/unknown'));

        // checkMimeMime
        $this->isTrue('checkMimeMime: igual', fn() => Mime::checkMimeMime('text/html', 'text/html'));
        $this->isTrue('checkMimeMime: via extensão', fn() => Mime::checkMimeMime('text/html', 'html'));
        $this->isFalse('checkMimeMime: diferente', fn() => Mime::checkMimeMime('text/html', 'image/png'));

        // checkMimeEx
        $this->isTrue('checkMimeEx: jpg vs image/jpeg', fn() => Mime::checkMimeEx('jpg', 'image/jpeg'));
        $this->isTrue('checkMimeEx: jpg vs jpg', fn() => Mime::checkMimeEx('jpg', 'jpg'));
        $this->isFalse('checkMimeEx: jpg vs png', fn() => Mime::checkMimeEx('jpg', 'image/png'));
        $this->isFalse('checkMimeEx: extensão desconhecida', fn() => Mime::checkMimeEx('xyz', 'text/plain'));
    }
};
