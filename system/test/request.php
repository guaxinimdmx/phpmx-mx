<?php

use PhpMx\Request;
use PhpMx\Snap;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Request */
return new class {

    use TerminalTestTrait;

    function run()
    {
        Snap::capture('request', Request::class);

        // type
        $this->isEqual('type: TERMINAL', fn() => Request::type(), 'TERMINAL');
        $this->isTrue('type: comparação case-insensitive', fn() => Request::type('terminal'));
        $this->isFalse('type: tipo errado', fn() => Request::type('GET'));

        // query
        Request::set_query('q', 'busca');
        $this->isEqual('query: parâmetro', fn() => Request::query('q'), 'busca');
        $this->isNull('query: não existe', fn() => Request::query('nao_existe'));
        $this->isTrue('query: todos retorna array', fn() => is_array(Request::query()));

        // body
        Request::set_body('campo', 'valor');
        $this->isEqual('body: parâmetro', fn() => Request::body('campo'), 'valor');
        $this->isNull('body: não existe', fn() => Request::body('nao_existe'));

        // route
        Request::set_route('id', 99);
        $this->isEqual('route: parâmetro', fn() => Request::route('id'), 99);
        $this->isNull('route: não existe', fn() => Request::route('nao_existe'));

        // header
        Request::set_header('accept', 'application/json');
        $this->isEqual('header: parâmetro', fn() => Request::header('accept'), 'application/json');

        // data: merge de route + query + body
        $this->isEqual('data: via query', fn() => Request::data('q'), 'busca');
        $this->isEqual('data: via body', fn() => Request::data('campo'), 'valor');
        $this->isEqual('data: via route', fn() => Request::data('id'), 99);
        $this->isNull('data: não existe', fn() => Request::data('nao_existe'));
        $this->isTrue('data: todos retorna array', fn() => is_array(Request::data()));

        // path / host / ssl
        $this->isTrue('path: retorna array', fn() => is_array(Request::path()));
        $this->isTrue('host: retorna string', fn() => is_string(Request::host()));
        $this->isTrue('ssl: retorna bool', fn() => is_bool(Request::ssl()));

        Snap::restore('request');

        // após restore, estado limpo
        $this->isNull('restore: query limpa', fn() => Request::query('q'));
        $this->isNull('restore: body limpa', fn() => Request::body('campo'));
        $this->isNull('restore: route limpa', fn() => Request::route('id'));
    }
};
