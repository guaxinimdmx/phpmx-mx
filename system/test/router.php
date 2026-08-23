<?php

use PhpMx\Router;
use PhpMx\Snap;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Router */
return new class {

    use TerminalTestTrait;

    function run()
    {
        Snap::capture('router', Router::class);

        // registro de rotas não lança exception
        $this->isNotThrow('get: registra rota', fn() => Router::get('test', 'Ctrl'));
        $this->isNotThrow('post: registra rota', fn() => Router::post('test', 'Ctrl'));
        $this->isNotThrow('put: registra rota', fn() => Router::put('test', 'Ctrl'));
        $this->isNotThrow('delete: registra rota', fn() => Router::delete('test', 'Ctrl'));
        $this->isNotThrow('add: get+post', fn() => Router::add('test/add', 'Ctrl'));
        $this->isNotThrow('full: todos os métodos', fn() => Router::full('test/full', 'Ctrl'));

        // parâmetros de rota não lançam
        $this->isNotThrow('get: rota com parâmetro', fn() => Router::get('users/[#id]', 'Ctrl'));
        $this->isNotThrow('get: rota curinga', fn() => Router::get('assets/...', 'Ctrl'));
        $this->isNotThrow('get: status como response', fn() => Router::get('bloqueado', STS_FORBIDDEN));

        // path: executa o closure e aplica prefixo
        $executed = false;
        Router::path('api', function () use (&$executed) {
            $executed = true;
            Router::get('users', 'Ctrl');
        });
        $this->isTrue('path: executa closure', fn() => $executed);

        // middleware: executa o closure
        $executed2 = false;
        Router::middleware(['auth'], function () use (&$executed2) {
            $executed2 = true;
            Router::get('privado', 'Ctrl');
        });
        $this->isTrue('middleware: executa closure', fn() => $executed2);

        // group: executa o closure com prefixo e middleware
        $executed3 = false;
        Router::group('admin', ['auth', 'admin'], function () use (&$executed3) {
            $executed3 = true;
            Router::get('dashboard', 'Ctrl');
        });
        $this->isTrue('group: executa closure', fn() => $executed3);

        Snap::restore('router');
    }
};
